// Update Sensors
//

var sensor_table = document.getElementById("sensor-table");
var i;
var auto_refresh_row;
var has_focus = false;
var override = false;
const C_REFRESH_NORMAL = 300;
const C_REFRESH_ERROR = 60;
var auto_refresh_counter = C_REFRESH_NORMAL;
var date_options = { year: 'numeric', month: 'short', day: 'numeric', hour: 'numeric', minute: 'numeric', timeZone: 'America/Los_Angeles', timeZoneName: 'short' };
// find the auto refresh row
for (i = 0; i < sensor_table.rows.length; i++) {
    if (sensor_table.rows[i].cells[0].innerHTML == "Auto Refresh") {
        auto_refresh_row = sensor_table.rows[i];
        break;
    }
}
if (i >= sensor_table.rows.length)
    console.log("Could not find update table");

auto_refresh_row.cells[1].innerHTML = "paused at";

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
        auto_refresh_row.cells[3].innerHTML = Intl.DateTimeFormat('en-US', date_options).format(new Date());
        var json = resp.responseJSON;

        var i = 1;
        Object.entries(json).forEach(([sensor, value]) => {
            sensor_table.rows[i].cells[1].innerHTML = value[0];
            var sensorTime = new Date(value[1]*1000);
            sensor_table.rows[i].cells[2].innerHTML.replace(/datetime=".+"/, 'datetime="' + sensorTime.toISOString() + '"');
	    sensor_table.rows[i].cells[3].innerHTML = Intl.DateTimeFormat('en-US', date_options).format(sensorTime);
            i++;
        });

        updating_sensors = false;
    })
        .fail(function() {
            auto_refresh_row.cells[1].innerHTML = "failed: " + resp.status + ".  Retrying in"
	    auto_refresh_counter = C_REFRESH_ERROR;
	    updating_sensors = false;
            return;
        });
}

setInterval(function() {
    if (has_focus || override) {
        auto_refresh_counter--;
        update_refresh_counter();
        if (auto_refresh_counter == 0) {
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
        auto_refresh_row.cells[1].innerHTML = "paused at";
}

function override_enable() {
    override = true;
    auto_refresh_row.cells[1].innerHTML = "in";
}

auto_refresh_row.cells[1].addEventListener("click", override_enable, false);
window.addEventListener("focus", windowHasFocus, false);
window.addEventListener("blur", windowLostFocus, false);
