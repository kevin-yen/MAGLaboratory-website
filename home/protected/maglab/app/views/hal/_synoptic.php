<svg id="maglab-synoptic-view" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" viewBox="120 30 480 564" height="564" width="480">
<defs>
<pattern id="diagonal-stripe-2" height="10" width="10" patternUnits="userSpaceOnUse">
<image height="10" width="10" y="0" x="0" xlink:href="data:image/svg+xml;base64,PHN2ZyB4bWxucz0naHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmcnIHdpZHRoPScxMCcgaGVpZ2h0PScxMCc+CiAgPHJlY3Qgd2lkdGg9JzEwJyBoZWlnaHQ9JzEwJyBmaWxsPSd3aGl0ZScvPgogIDxwYXRoIGQ9J00tMSwxIGwyLC0yCiAgICAgICAgICAgTTAsMTAgbDEwLC0xMAogICAgICAgICAgIE05LDExIGwyLC0yJyBzdHJva2U9J2JsYWNrJyBzdHJva2Utd2lkdGg9JzInLz4KPC9zdmc+"></image>
</pattern>
</defs>
<g id="root">
<g id="Background">
<rect id="The-Unknown" style="fill:url(#diagonal-stripe-2) #999999" width="977.5" height="624" x="260.5" y="0"></rect>
<rect id="Outside-Asphalt" x="0" y="0" height="624" width="260.5" style="fill:#4d4d4d"></rect>
<?php if (!$isTechBad && $isOpen) { ?>
<rect id="Space-Floor" width="942.5" height="472" x="260.5" y="75" style="fill:#ffffff"></rect>
<?php } else if (!$isTechBad) { ?>
<rect id="Space-Floor" width="942.5" height="472" x="260.5" y="75" style="fill:#e0e0d5"></rect>
<?php } else { ?>
<rect id="Space-Floor" width="942.5" height="472" x="260.5" y="75" style="fill:#e0d5d5"></rect>
<?php } ?>
<text id="Space_Space" style="font-style:normal;font-weight:normal;font-size:40px;line-height:1.25;font-family:sans-serif;fill:#000000;fill-opacity:1;stroke:none" y="118" x="290" xml:space="preserve">
<tspan id="Space_Span_Space" y="118" x="290">Space</tspan>
</text>
<?php if ($isTechBad) { ?>
<text id="Space_Openness" style="font-style:normal;font-weight:normal;font-size:40px;line-height:1.25;font-family:sans-serif;fill:#ff0000;fill-opacity:1;stroke:none" x="290" y="160" visibility="visible" xml:space="preserve">
<tspan id="Space_Span_Openness" x="290" y="160">Unknown</tspan>
</text>
<?php } else if ($isOpen) { ?>
<text id="Space_Openness" style="font-style:normal;font-weight:normal;font-size:40px;line-height:1.25;font-family:sans-serif;fill:#2ecc40;fill-opacity:1;stroke:none" x="290" y="160" visibility="visible" xml:space="preserve">
<tspan id="Space_Span_Openness" x="290" y="160">Open</tspan>
</text>
<?php } else { ?>
<text id="Space_Openness" style="font-style:normal;font-weight:normal;font-size:40px;line-height:1.25;font-family:sans-serif;fill:#8a6d3b;fill-opacity:1;stroke:none" x="290" y="160" visibility="visible" xml:space="preserve">
<tspan id="Space_Span_Openness" x="290" y="160">Closed</tspan>
</text>
<?php } ?>
</g>
<g id="Walls">
<path id="Electronics-Room_L0" style="fill:none;stroke:#000000;stroke-width:6px;stroke-linecap:butt;stroke-linejoin:miter;stroke-opacity:1" d="M 959.5,332 V 285"></path>
<path id="Electronics-Room_L1" style="fill:none;stroke:#000000;stroke-width:6px;stroke-linecap:butt;stroke-linejoin:miter;stroke-opacity:1" d="M 959.5,544 V 386"></path>
<path id="Conference-Room_B0" style="fill:none;stroke:#000000;stroke-width:6px;stroke-linecap:butt;stroke-linejoin:miter;stroke-opacity:1" d="m 942,284.5 h 258"></path>
<path id="Conference-Room_L0" style="fill:none;stroke:#000000;stroke-width:6px;stroke-linecap:butt;stroke-linejoin:miter;stroke-opacity:1" d="M 888,284.5 797,284.5 V 78"></path>
<path id="Bathroom_R0" style="fill:none;stroke:#000000;stroke-width:6px;stroke-linecap:butt;stroke-linejoin:miter;stroke-opacity:1" d="m 555,395.5 h 27.5 V 544"></path>
<path id="Bathroom_T0" style="fill:none;stroke:#000000;stroke-width:6px;stroke-linecap:butt;stroke-linejoin:miter;stroke-opacity:1" d="M 501,395.5 H 469.5"></path>
<path id="Kitchen_R0" style="fill:none;stroke:#000000;stroke-width:6px;stroke-linecap:butt;stroke-linejoin:miter;stroke-opacity:1" d="m 447,337.5 h 22.5 V 544"></path>
<path id="Kitchen_T0" style="fill:none;stroke:#000000;stroke-width:6px;stroke-linecap:butt;stroke-linejoin:miter;stroke-opacity:1" d="M 393,337.5 H 263.5"></path>
<path id="Space_L0" style="fill:none;stroke:#000000;stroke-width:6px;stroke-linecap:butt;stroke-linejoin:miter;stroke-opacity:1" d="M 263.5,452 V 305"></path>
<path id="Space_Wall" style="fill:none;stroke:#000000;stroke-width:6px;stroke-linecap:butt;stroke-linejoin:miter;stroke-opacity:1" d="m 263.5,506 v 38 h 936.5 v -466 h -936.5 v 38"></path>
</g>
<g id="Unmonitored-Doors">
<path id="Electronics-Room_Door" style="fill:none;stroke:#999999;stroke-width:4px;stroke-linecap:butt;stroke-linejoin:miter;stroke-opacity:1" d="m 959.5,332 v 54"></path>
<path id="Conference-Room_Door" style="fill:none;stroke:#999999;stroke-width:4px;stroke-linecap:butt;stroke-linejoin:miter;stroke-opacity:1" d="m 888,284.5 h 54"></path>
<path id="Bathroom-Door" style="fill:none;stroke:#999999;stroke-width:4px;stroke-linecap:butt;stroke-linejoin:miter;stroke-opacity:1" d="m 501,395.5 h 54"></path>
<path id="Kitchen-Door" style="fill:none;stroke:#999999;stroke-width:4px;stroke-linecap:butt;stroke-linejoin:miter;stroke-opacity:1" d="m 393,337.5 h 54"></path>
</g>
<g id="Pod-Bay-Door">
<?php if (!$isTechBad && $latestStatus['Pod Bay Door'][0] == 'Open') { ?>
<path id="Pod-Bay-Door_Closed" style="fill:none;stroke:#2ecc40;stroke-width:4px;stroke-linecap:butt;stroke-linejoin:miter;stroke-opacity:1" visibility="hidden" d="M 263.5,116 V 305"></path>
<path id="Pod-Bay-Door_Open-0" style="fill:none;stroke:#ffdc00;stroke-width:4px;stroke-linecap:butt;stroke-linejoin:miter;stroke-opacity:1" visibility="visible" d="M 263.5,116 v 15"></path>
<path id="Pod-Bay-Door_Open-1" style="fill:none;stroke:#ffdc00;stroke-width:4px;stroke-linecap:butt;stroke-linejoin:miter;stroke-opacity:1" visibility="visible" d="M 263.5,305 v -15"></path>
<?php } else if (!$isTechBad) { ?>
<path id="Pod-Bay-Door_Closed" style="fill:none;stroke:#2ecc40;stroke-width:4px;stroke-linecap:butt;stroke-linejoin:miter;stroke-opacity:1" visibility="visible" d="M 263.5,116 V 305"></path>
<path id="Pod-Bay-Door_Open-0" style="fill:none;stroke:#ffdc00;stroke-width:4px;stroke-linecap:butt;stroke-linejoin:miter;stroke-opacity:1" visibility="hidden" d="M 263.5,116 v 15"></path>
<path id="Pod-Bay-Door_Open-1" style="fill:none;stroke:#ffdc00;stroke-width:4px;stroke-linecap:butt;stroke-linejoin:miter;stroke-opacity:1" visibility="hidden" d="M 263.5,305 v -15"></path>
<?php } ?>
<?php if ($isTechBad) { ?>
<g id="Pod-Bay-Door_Fail" visibility="visible">
<rect style="fill:none;stroke:#ff0000;stroke-width:1px" x="261" y="116" width="20" height="189"></rect>
<path style="fill:none;stroke:#ff0000;stroke-width:1px;stroke-linecap:round;stroke-linejoin:miter;stroke-opacity:1" d="M 281,116 261,305"></path>
<path style="fill:none;stroke:#ff0000;stroke-width:1px;stroke-linecap:round;stroke-linejoin:miter;stroke-opacity:1" d="M 281,305 261,116"></path>
</g>
<?php } else { ?>
<g id="Pod-Bay-Door_Fail" visibility="hidden">
<rect style="fill:none;stroke:#ff0000;stroke-width:1px" x="261" y="116" width="20" height="189"></rect>
<path style="fill:none;stroke:#ff0000;stroke-width:1px;stroke-linecap:round;stroke-linejoin:miter;stroke-opacity:1" d="M 281,116 261,305"></path>
<path style="fill:none;stroke:#ff0000;stroke-width:1px;stroke-linecap:round;stroke-linejoin:miter;stroke-opacity:1" d="M 281,305 261,116"></path>
</g>
<?php } ?>
</g>
<g id="Front-Door">
<?php if (!$isTechBad && $latestStatus['Front Door'][0] == 'Open') { ?>
<path id="Front-Door_Open" style="fill:none;stroke:#ffdc00;stroke-width:4px;stroke-linecap:round;stroke-linejoin:miter;stroke-opacity:1" visibility="visible" d="M 263.5,506 225.32,468.82"></path>
<path id="Front-Door_Closed" style="fill:none;stroke:#2ecc40;stroke-width:4px;stroke-linecap:butt;stroke-linejoin:miter;stroke-opacity:1" visibility="hidden" d="m 263.5,452 v 54"></path>
<?php } else if (!$isTechBad) { ?>
<path id="Front-Door_Open" style="fill:none;stroke:#ffdc00;stroke-width:4px;stroke-linecap:round;stroke-linejoin:miter;stroke-opacity:1" visibility="hidden" d="M 263.5,506 225.32,468.82"></path>
<path id="Front-Door_Closed" style="fill:none;stroke:#2ecc40;stroke-width:4px;stroke-linecap:butt;stroke-linejoin:miter;stroke-opacity:1" visibility="visible" d="m 263.5,452 v 54"></path>
<?php } else { ?>
<path id="Front-Door_Open" style="fill:none;stroke:#ffdc00;stroke-width:4px;stroke-linecap:round;stroke-linejoin:miter;stroke-opacity:1" visibility="hidden" d="M 263.5,506 225.32,468.82"></path>
<path id="Front-Door_Closed" style="fill:none;stroke:#2ecc40;stroke-width:4px;stroke-linecap:butt;stroke-linejoin:miter;stroke-opacity:1" visibility="hidden" d="m 263.5,452 v 54"></path>
<?php } ?>
<?php if ($isTechBad) { ?>
<g id="Front-Door_Fail" visibility="visible">
<rect style="fill:#999999;stroke:#ff0000;stroke-width:1" x="223" y="452.5" width="43" height="53"></rect>
<path style="fill:none;stroke:#ff0000;stroke-width:1px;stroke-linecap:round;stroke-linejoin:miter;stroke-opacity:1" d="m 223,505.5 43,-53"></path>
<path style="fill:none;stroke:#ff0000;stroke-width:1px;stroke-linecap:round;stroke-linejoin:miter;stroke-opacity:1" d="m 223,452.5 43,53"></path>
</g>
<?php } else { ?>
<g id="Front-Door_Fail" visibility="hidden">
<rect style="fill:#999999;stroke:#ff0000;stroke-width:1" x="223" y="452.5" width="43" height="53"></rect>
<path style="fill:none;stroke:#ff0000;stroke-width:1px;stroke-linecap:round;stroke-linejoin:miter;stroke-opacity:1" d="m 223,505.5 43,-53"></path>
<path style="fill:none;stroke:#ff0000;stroke-width:1px;stroke-linecap:round;stroke-linejoin:miter;stroke-opacity:1" d="m 223,452.5 43,53"></path>
</g>
<?php } ?>
</g>
<g id="Shop-Motion">
<path id="Shop-Motion_Sensor" style="fill:#000000;stroke:none" d="M480,239 a1,1 0 0,0 10,0"></path>
<path id="Shop-Motion_IR-Wave0" style="fill:none;stroke:#000000;stroke-width:1px;stroke-linecap:butt;stroke-linejoin:miter;stroke-opacity:1" d="m 470,239 a 15,15 0 0 0 15,15"></path>
<path id="Shop-Motion_IR-Wave1" style="fill:none;stroke:#000000;stroke-width:1px;stroke-linecap:butt;stroke-linejoin:miter;stroke-opacity:1" d="m 455,239 a 30,30 0 0 0 30,30"></path>
<path id="Shop-Motion_IR-Wave2" style="fill:none;stroke:#000000;stroke-width:1px;stroke-linecap:butt;stroke-linejoin:miter;stroke-opacity:1" d="m 440,239 a 45,45 0 0 0 45,45"></path>
<?php if (!$isTechBad && $latestStatus['Shop Motion'][2] == true) { ?>
<g id="Shop-Motion_Motion" visibility="visible">
<circle id="Shop-Motion_Head" style="fill:#2ecc40" cx="462" cy="277.5" r="5.5"></circle>
<path id="Shop-Motion_Torso" style="fill:none;stroke:#2ecc40;stroke-width:12px;stroke-linecap:round;stroke-linejoin:miter;stroke-opacity:1" d="m 461,291.5 -3,14"></path>
<path id="Shop-Motion_Legs" style="fill:none;stroke:#2ecc40;stroke-width:5px;stroke-linecap:round;stroke-linejoin:round;stroke-opacity:1" d="m 468,328 v -13 l -6.5,-6.5 -7,-1 -2.5,9.5 -9,9"></path>
<path id="Shop-Motion_Arms" style="fill:none;stroke:#2ecc40;stroke-width:5px;stroke-linecap:round;stroke-linejoin:round;stroke-opacity:1" d="m 448,303 2,-8 8.5,-6 5.5,1 6,10 6,2.5"></path>
</g>
<?php } else { ?>
<g id="Shop-Motion_Motion" visibility="hidden">
<circle id="Shop-Motion_Head" style="fill:#2ecc40" cx="462" cy="277.5" r="5.5"></circle>
<path id="Shop-Motion_Torso" style="fill:none;stroke:#2ecc40;stroke-width:12px;stroke-linecap:round;stroke-linejoin:miter;stroke-opacity:1" d="m 461,291.5 -3,14"></path>
<path id="Shop-Motion_Legs" style="fill:none;stroke:#2ecc40;stroke-width:5px;stroke-linecap:round;stroke-linejoin:round;stroke-opacity:1" d="m 468,328 v -13 l -6.5,-6.5 -7,-1 -2.5,9.5 -9,9"></path>
<path id="Shop-Motion_Arms" style="fill:none;stroke:#2ecc40;stroke-width:5px;stroke-linecap:round;stroke-linejoin:round;stroke-opacity:1" d="m 448,303 2,-8 8.5,-6 5.5,1 6,10 6,2.5"></path>
</g>
<?php } ?>
<?php if ($isTechBad)         { ?>
<rect id="Shop-Motion_Enclosure" style="fill:none;stroke:#ff0000" x="429" y="239" width="62" height="95"></rect>
<g id="Shop-Motion_Fail" visibility="visible">
<path id="Shop-Motion_Fw-Slash" style="fill:none;stroke:#ff0000;stroke-width:1px;stroke-linecap:butt;stroke-linejoin:miter;stroke-opacity:1" d="m 491,239 -62,95"></path>
<path id="Shop-Motion_Bk-Slash" style="fill:none;stroke:#ff0000;stroke-width:1px;stroke-linecap:butt;stroke-linejoin:miter;stroke-opacity:1" d="m 429,239 62,95"></path>
</g>
<?php } else { ?>
<rect id="Shop-Motion_Enclosure" style="fill:none;stroke:#000000" x="429" y="239" width="62" height="95"></rect>
<g id="Shop-Motion_Fail" visibility="hidden">
<path id="Shop-Motion_Fw-Slash" style="fill:none;stroke:#ff0000;stroke-width:1px;stroke-linecap:butt;stroke-linejoin:miter;stroke-opacity:1" d="m 491,239 -62,95"></path>
<path id="Shop-Motion_Bk-Slash" style="fill:none;stroke:#ff0000;stroke-width:1px;stroke-linecap:butt;stroke-linejoin:miter;stroke-opacity:1" d="m 429,239 62,95"></path>
</g>
<?php } ?>
</g>
<g id="Office-Motion">
<path id="Office-Motion_Sensor" style="fill:#000000;stroke:none" d="M318,341 a1,1 0 0,0 10,0"></path>
<path id="Office-Motion_IR-Wave0" style="fill:none;stroke:#000000;stroke-width:1px;stroke-linecap:butt;stroke-linejoin:miter;stroke-opacity:1" d="m 308,341 a 15,15 0 0 0 15,15"></path>
<path id="Office-Motion_IR-Wave1" style="fill:none;stroke:#000000;stroke-width:1px;stroke-linecap:butt;stroke-linejoin:miter;stroke-opacity:1" d="m 293,341 a 30,30 0 0 0 30,30"></path>
<path id="Office-Motion_IR-Wave2" style="fill:none;stroke:#000000;stroke-width:1px;stroke-linecap:butt;stroke-linejoin:miter;stroke-opacity:1" d="m 278,341 a 45,45 0 0 0 45,45"></path>
<?php if (!$isTechBad && $latestStatus['Office Motion'][2] == true) { ?>
<g id="Office-Motion_Motion" visibility="visible">
<circle id="Office-Motion_Head" style="fill:#2ecc40" cx="300" cy="379.5" r="5.5"></circle>
<path id="Office-Motion_Torso" style="fill:none;stroke:#2ecc40;stroke-width:12px;stroke-linecap:round;stroke-linejoin:miter;stroke-opacity:1" d="m 299,393.5 -3,14"></path>
<path id="Office-Motion_Legs" style="fill:none;stroke:#2ecc40;stroke-width:5px;stroke-linecap:round;stroke-linejoin:round;stroke-opacity:1" d="m 306,430 v -13 l -6.5,-6.5 -7,-1 -2.5,9.5 -9,9"></path>
<path id="Office-Motion_Arms" style="fill:none;stroke:#2ecc40;stroke-width:5px;stroke-linecap:round;stroke-linejoin:round;stroke-opacity:1" d="m 286,405 2,-8 8.5,-6 5.5,1 6,10 6,2.5"></path>
</g>
<?php } else { ?>
<g id="Office-Motion_Motion" visibility="hidden">
<circle id="Office-Motion_Head" style="fill:#2ecc40" cx="300" cy="379.5" r="5.5"></circle>
<path id="Office-Motion_Torso" style="fill:none;stroke:#2ecc40;stroke-width:12px;stroke-linecap:round;stroke-linejoin:miter;stroke-opacity:1" d="m 299,393.5 -3,14"></path>
<path id="Office-Motion_Legs" style="fill:none;stroke:#2ecc40;stroke-width:5px;stroke-linecap:round;stroke-linejoin:round;stroke-opacity:1" d="m 306,430 v -13 l -6.5,-6.5 -7,-1 -2.5,9.5 -9,9"></path>
<path id="Office-Motion_Arms" style="fill:none;stroke:#2ecc40;stroke-width:5px;stroke-linecap:round;stroke-linejoin:round;stroke-opacity:1" d="m 286,405 2,-8 8.5,-6 5.5,1 6,10 6,2.5"></path>
</g>
<?php } ?>
<?php if ($isTechBad) { ?>
<rect id="Office-Motion_Enclosure" style="fill:none;stroke:#ff0000" x="267" y="341" width="62" height="95"></rect>
<g id="Office-Motion_Fail" visibility="visible">
<path id="Office-Motion_Fw-Slash" style="fill:none;stroke:#ff0000;stroke-width:1px;stroke-linecap:butt;stroke-linejoin:miter;stroke-opacity:1" d="m 329,341 -62,95"></path>
<path id="Office-Motion_Bk-Slash" style="fill:none;stroke:#ff0000;stroke-width:1px;stroke-linecap:butt;stroke-linejoin:miter;stroke-opacity:1" d="m 267,341 62,95"></path>
</g>
<?php } else  { ?>
<rect id="Office-Motion_Enclosure" style="fill:none;stroke:#000000" x="267" y="341" width="62" height="95"></rect>
<g id="Office-Motion_Fail" visibility="hidden">
<path id="Office-Motion_Fw-Slash" style="fill:none;stroke:#ff0000;stroke-width:1px;stroke-linecap:butt;stroke-linejoin:miter;stroke-opacity:1" d="m 329,341 -62,95"></path>
<path id="Office-Motion_Bk-Slash" style="fill:none;stroke:#ff0000;stroke-width:1px;stroke-linecap:butt;stroke-linejoin:miter;stroke-opacity:1" d="m 267,341 62,95"></path>
</g>
<?php } ?>
</g>
<g id="HAL">
<text id="HAL_Text" style="font-style:normal;font-weight:normal;font-size:36px;line-height:1.25;font-family:sans-serif;fill:#000000;fill-opacity:1;stroke:none">
<tspan x="302" y="330">HAL</tspan>
</text>
<?php if ($isTechBad) { ?>
<rect id="HAL_Enclosure" style="fill:none;stroke:#ff0000" x="300" y="300" width="75" height="34"></rect>
<g id="HAL_Fail" visibility="visible">
<path id="HAL_Bk-Slash" style="fill:none;stroke:#ff0000;stroke-width:1px;stroke-linecap:butt;stroke-linejoin:miter;stroke-opacity:1" d="m 300,300 75,34"></path>
<path id="HAL_Fw-Slash" style="fill:none;stroke:#ff0000;stroke-width:1px;stroke-linecap:butt;stroke-linejoin:miter;stroke-opacity:1" d="m 375,300 -75,34"></path>
</g>
<?php } else { ?>
<rect id="HAL_Enclosure" style="fill:none;stroke:#000000" x="300" y="300" width="75" height="34"></rect>
<g id="HAL_Fail" visibility="hidden">
<path id="HAL_Bk-Slash" style="fill:none;stroke:#ff0000;stroke-width:1px;stroke-linecap:butt;stroke-linejoin:miter;stroke-opacity:1" d="m 300,300 75,34"></path>
<path id="HAL_Fw-Slash" style="fill:none;stroke:#ff0000;stroke-width:1px;stroke-linecap:butt;stroke-linejoin:miter;stroke-opacity:1" d="m 375,300 -75,34"></path>
</g>
<?php } ?>
</g>
<g id="Temperature">
<?php preg_match ('/^.+?(?=\.)/', $latestStatus['Temperature'][0], $wholeTemperature); ?>
<?php if (!$isTechBad && sizeof($wholeTemperature) > 0) { ?>
<text id="Temperature_Temperature" style="font-style:normal;font-weight:normal;font-size:20px;line-height:1.25;font-family:sans-serif;fill:#000000;fill-opacity:1;stroke:none">
<tspan x="321" y="290">
<?php print($wholeTemperature[0] . '&#xB0;C'); ?>
</tspan>
</text>
<?php } else { ?>
<text id="Temperature_Temperature" style="font-style:normal;font-weight:normal;font-size:20px;line-height:1.25;font-family:sans-serif;fill:#000000;fill-opacity:1;stroke:none">
<tspan x="321" y="290">XX&#xB0;C</tspan>
</text>
<?php } ?>
<text id="Temperature_Symbol" style="font-style:normal;font-weight:normal;font-size:26px;line-height:1.25;font-family:sans-serif;fill:#000000;fill-opacity:1;stroke:none">
<tspan x="298.5" y="292">&#x1f321;</tspan>
</text>
<?php if ($isTechBad) { ?>
<rect id="Temperature_Enclosure" style="fill:none;stroke:#ff0000" x="300" y="265" width="75" height="34"></rect>
<g id="Temperature_Fail" visibility="visible">
<path id="Temperature_Bk-Slash" style="fill:none;stroke:#ff0000;stroke-width:1px;stroke-linecap:butt;stroke-linejoin:miter;stroke-opacity:1" d="m 300,265 75,34"></path>
<path id="Temperature_Fw-Slash" style="fill:none;stroke:#ff0000;stroke-width:1px;stroke-linecap:butt;stroke-linejoin:miter;stroke-opacity:1" d="m 375,265 -75,34"></path>
</g>
<?php } else { ?>
<rect id="Temperature_Enclosure" style="fill:none;stroke:#000000" x="300" y="265" width="75" height="34"></rect>
<g id="Temperature_Fail" visibility="hidden">
<path id="Temperature_Bk-Slash" style="fill:none;stroke:#ff0000;stroke-width:1px;stroke-linecap:butt;stroke-linejoin:miter;stroke-opacity:1" d="m 300,265 75,34"></path>
<path id="Temperature_Fw-Slash" style="fill:none;stroke:#ff0000;stroke-width:1px;stroke-linecap:butt;stroke-linejoin:miter;stroke-opacity:1" d="m 375,265 -75,34"></path>
</g>
<?php } ?>
</g>
</g>
</svg>
