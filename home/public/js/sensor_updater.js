// Update Sensors
//

var sensor_table = document.getElementById("sensor-table");
var i;
var auto_refresh_row;
var has_focus = document.hasFocus();
var override = false;
const C_REFRESH_NORMAL = 300;
const C_REFRESH_ERROR = 60;
var auto_refresh_counter = C_REFRESH_NORMAL;
var date_options = {
    year: 'numeric',
    month: 'short', 
    day: 'numeric', 
    hour: 'numeric',
    minute: 'numeric',
    timeZone: 'America/Los_Angeles',
    timeZoneName: 'short'
};

// find the auto refresh row
for (i = 0; i < sensor_table.rows.length; i++) {
    if (sensor_table.rows[i].cells[0].innerHTML == "Auto Refresh") {
        auto_refresh_row = sensor_table.rows[i];
        break;
    }
}
if (i >= sensor_table.rows.length)
    console.log("Could not find update table");

auto_refresh_row.cells[1].innerHTML = "paused";

function update_refresh_counter() {
    auto_refresh_row.cells[2].innerHTML = auto_refresh_counter + " seconds";
}

var updating_sensors = false;
function update_sensors() {
    auto_refresh_counter = C_REFRESH_NORMAL;
    if (updating_sensors)
        return;

    updating_sensors = true;

    var resp = $.getJSON("/haldor/status", function() {
        auto_refresh_row.cells[1].innerHTML = "in"
        auto_refresh_row.cells[3].innerHTML = Intl.DateTimeFormat('en-US',
            date_options).format(new Date());
        var json = resp.responseJSON;
        var last_update_time = 0;
        var i = 1;

        // update sensor table
        // note that the sensor table updater depends on the table being in the
        // right order.  The PHP backend also makes the sensor table in the
        // correct order, but this is not guaranteed to update over different
        // iterations of the sensor setup.  A full refresh is needed to
        // guarantee that these changes work throughout.
        Object.entries(json).forEach(([sensor, value]) => {
            if (sensor != "LastUpdate") {
                sensor_table.rows[i].cells[1].innerHTML = value[0];
                var sensorTime = new Date(value[1]*1000);
                var timeago_update = sensor_table.rows[i].cells[2].innerHTML
                    .replace(/datetime=".+"\>.*\</,
                        'datetime="' + sensorTime.toISOString() + '"><');
                sensor_table.rows[i].cells[2].innerHTML = timeago_update;
                sensor_table.rows[i].cells[3].innerHTML = Intl.DateTimeFormat(
                    'en-US', date_options).format(sensorTime);
                i++;
            } else {
                last_update_time = value[1]*1000;
            }
        });

        // since all the timeago instances were destroyed, they need to be
        // restored
        $('time.timeago').timeago();

        // calculate space tech badness
        var isTechBad = last_update_time < (new Date())*1 - 60*15*1000;

	// update space "openness" alert
        var openness = document.getElementById("openness");
        if (isTechBad) {
            openness.className = "alert alert-danger";
            openness.innerHTML = 
            "<h1>We are <strong>HAVING TECHNICAL DIFFICULTIES</strong></h1>";	
        } else {
            if (json["Open Switch"][2] == true) {
                openness.className = "alert alert-success";
                openness.innerHTML = "<h1>We are <strong>OPEN</strong></h1>";	
            } else {
                openness.className = "alert alert-warning";
                openness.innerHTML = "<h1>We are <strong>CLOSED</strong></h1>";	
            }
	}
	
	// update SVG
	// note that the SVG is generated mainly from the PHP and these items in
	// the SVG are only updated from the JS present here.
	// - Update Openness and floor
	var synoptic = document.getElementById("maglab-synoptic-view");
        if (isTechBad)
        {
            synoptic.getElementById("Space-Floor").style.fill = "#e0d5d5";
            synoptic.getElementById("Space_Openness").style.fill = "#ff0000";
            synoptic.getElementById("Space_Openness").innerHTML = "Unknown";
        }
        else if (json["Open Switch"][2] == true)
        {
            synoptic.getElementById("Space-Floor").style.fill = "#ffffff";
            synoptic.getElementById("Space_Openness").style.fill = "#2ecc40";
            synoptic.getElementById("Space_Openness").innerHTML = "Open";
        }
        else
        {
            synoptic.getElementById("Space-Floor").style.fill = "#e0e0d5";
            synoptic.getElementById("Space_Openness").style.fill = "#8a6d3b";
            synoptic.getElementById("Space_Openness").innerHTML = "Closed";
        }

        // - Update Pod Bay Door
        if (isTechBad)
        {
            synoptic.getElementById("Pod-Bay-Door_Closed").setAttribute(
                "visibility", "hidden");
            synoptic.getElementById("Pod-Bay-Door_Open-0").setAttribute( 
                "visibility", "hidden");
            synoptic.getElementById("Pod-Bay-Door_Open-1").setAttribute( 
                "visibility", "hidden");
            synoptic.getElementById("Pod-Bay-Door_Fail").setAttribute(
                "visibility", "visible");
        }
        else if (json["Pod Bay Door"][2] == true)
        {
            synoptic.getElementById("Pod-Bay-Door_Closed").setAttribute(
                "visibility", "hidden");
            synoptic.getElementById("Pod-Bay-Door_Open-0").setAttribute( 
                "visibility", "visible");
            synoptic.getElementById("Pod-Bay-Door_Open-1").setAttribute( 
                "visibility", "visible");
            synoptic.getElementById("Pod-Bay-Door_Fail").setAttribute(
                "visibility", "hidden");
        }
        else
        {
            synoptic.getElementById("Pod-Bay-Door_Closed").setAttribute(
                "visibility", "visible");
            synoptic.getElementById("Pod-Bay-Door_Open-0").setAttribute( 
                "visibility", "hidden");
            synoptic.getElementById("Pod-Bay-Door_Open-1").setAttribute( 
                "visibility", "hidden");
            synoptic.getElementById("Pod-Bay-Door_Fail").setAttribute(
                "visibility", "hidden");
        }

        if (isTechBad)
        {
            synoptic.getElementById("Front-Door_Closed").setAttribute(
                "visibility", "hidden");
            synoptic.getElementById("Front-Door_Open").setAttribute(
                "visibility", "hidden");
            synoptic.getElementById("Front-Door_Fail").setAttribute(
                "visibility", "visible");
        }
        else if (json["Front Door"][2] == true)
        {
            synoptic.getElementById("Front-Door_Closed").setAttribute(
                "visibility", "hidden");
            synoptic.getElementById("Front-Door_Open").setAttribute( 
                "visibility", "visible");
            synoptic.getElementById("Front-Door_Fail").setAttribute(
                "visibility", "hidden");
        }
        else
        {
            synoptic.getElementById("Front-Door_Closed").setAttribute(
                "visibility", "visible");
            synoptic.getElementById("Front-Door_Open").setAttribute( 
                "visibility", "hidden");
            synoptic.getElementById("Front-Door_Fail").setAttribute(
                "visibility", "hidden");
        }

        if (isTechBad)
        {
            synoptic.getElementById("Shop-Motion_Motion").setAttribute(
                "visibility", "hidden");
            synoptic.getElementById("Shop-Motion_Fail").setAttribute(
                "visibility", "visible");
            synoptic.getElementById("Shop-Motion_Enclosure").style.stroke = 
                "#ff0000";
        }
        else if (json["Shop Motion"][2] == true)
        {
            synoptic.getElementById("Shop-Motion_Motion").setAttribute(
                "visibility", "visible");
            synoptic.getElementById("Shop-Motion_Fail").setAttribute(
                "visibility", "hidden");
            synoptic.getElementById("Shop-Motion_Enclosure").style.stroke =
                "#000000";
        }
        else
        {
            synoptic.getElementById("Shop-Motion_Motion").setAttribute(
                "visibility", "hidden");
            synoptic.getElementById("Shop-Motion_Fail").setAttribute(
                "visibility", "hidden");
            synoptic.getElementById("Shop-Motion_Enclosure").style.stroke = 
                "#000000";
        }

        if (isTechBad)
        {
            synoptic.getElementById("Office-Motion_Motion").setAttribute(
                "visibility", "hidden");
            synoptic.getElementById("Office-Motion_Fail").setAttribute(
                "visibility", "visible");
            synoptic.getElementById("Office-Motion_Enclosure").style.stroke = 
                "#ff0000";
        }
        else if (json["Office Motion"][2] == true)
        {
            synoptic.getElementById("Office-Motion_Motion").setAttribute(
                "visibility", "visible");
            synoptic.getElementById("Office-Motion_Fail").setAttribute(
                "visibility", "hidden");
            synoptic.getElementById("Office-Motion_Enclosure").style.stroke = 
                "#000000";
        }
        else
        {
            synoptic.getElementById("Office-Motion_Motion").setAttribute(
                "visibility", "hidden");
            synoptic.getElementById("Office-Motion_Fail").setAttribute(
                "visibility", "hidden");
            synoptic.getElementById("Office-Motion_Enclosure").style.stroke = 
                "#000000";
        }

        if (isTechBad)
        {
            synoptic.getElementById("HAL_Fail").setAttribute(
                "visibility", "visible");
            synoptic.getElementById("HAL_Enclosure").style.stroke = "#ff0000";
        }
        else
        {
            synoptic.getElementById("HAL_Fail").setAttribute(
                "visibility", "hidden");
            synoptic.getElementById("HAL_Enclosure").style.stroke = "#000000";
        }


        if (isTechBad)
        {
            synoptic.getElementById("Shop-Temp_Temperature").innerHTML =
                synoptic.getElementById("Shop-Temp_Temperature").innerHTML
                    .replace(/([^>]+>?\s+)([0-9]+)(.+)/g, "$1" + "XX" + "$3");
            synoptic.getElementById("Shop-Temp_Fail").setAttribute(
                "visibility", "visible");
            synoptic.getElementById("Shop-Temp_Enclosure").style.stroke = 
                "#ff0000";
        }
        else
        {
            var temp = Math.round(json["Shop-Temp"][0].match(/[^ ]+/)*1);
            synoptic.getElementById("Shop-Temp_Temperature").innerHTML =
                synoptic.getElementById("Shop-Temp_Temperature").innerHTML
                    .replace(/([^>]+>?\s+)([0-9]+)(.+)/g, "$1" + temp 
                        + "$3");
            synoptic.getElementById("Shop-Temp_Fail").setAttribute(
                "visibility", "hidden");
            synoptic.getElementById("Shop-Temp_Enclosure").style.stroke = 
                "#000000";
        }

        updating_sensors = false;
    })
        .fail(function() {
            auto_refresh_row.cells[1].innerHTML = "failed: " + resp.status 
                + ".  Retrying in";
	    auto_refresh_counter = C_REFRESH_ERROR;
	    updating_sensors = false;
            return;
        });
}

setInterval(function() {
    if (auto_refresh_counter > 0)
        auto_refresh_counter--;
    update_refresh_counter();
    if (has_focus || override) {
        if (auto_refresh_counter <= 0) {
            update_sensors();
            update_refresh_counter();
	}
    }
}, 1000);

update_refresh_counter();

function windowHasFocus() {
    has_focus = true;
    auto_refresh_row.cells[1].innerHTML = "in";
}

function windowLostFocus() {
    has_focus = false;
    if (override == false)
        auto_refresh_row.cells[1].innerHTML = "paused";
}

function override_enable() {
    override = true;
    auto_refresh_row.cells[1].innerHTML = "in";
}

function maybeUpdate() {
    if (auto_refresh_counter <= 0) {
        update_sensors();
        update_refresh_counter();
    }
}

auto_refresh_row.cells[1].addEventListener("click", override_enable, false);
window.addEventListener("focus", windowHasFocus, false);
window.addEventListener("blur", windowLostFocus, false);
window.addEventListener("click", maybeUpdate, false);
window.addEventListener("mousemove", maybeUpdate, false);
window.addEventListener("keypress", maybeUpdate, false);
window.addEventListener("scroll", maybeUpdate, false);
document.addEventListener("touchMove", maybeUpdate, false);
document.addEventListener("touchEnd", maybeUpdate, false);
