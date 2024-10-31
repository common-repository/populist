<?php
echo '<style>
a.inf {text-decoration: none; color: #222; cursor: help; border: 0px; }
a.inf:hover {position: relative;}
a.inf span {display: none;}
a.inf:hover span {display: block; position: absolute; top: 0px; left: -160px; background-color: #fff; border: 1px solid #ccc; padding: 4px; width: 150px; }
a.inf span ul{list-style-type: none; padding: 0; margin: 0;}

.slmodule { 
background-color: #fff;
width: 45%;
float: left;
margin: 1em;
padding: 0 0 1em 0;
border: 1px solid #dfdfdf;
-moz-border-radius: 6px;
-khtml-border-radius: 6px;
-webkit-border-radius: 6px;
}
.slmodule h3 {
background: #dfdfdf url("./images/gray-grad.png") repeat-x left top;
text-shadow: #fff 0 1px 0;
display: block;
margin: 0px;
padding: 6px;
font-size: 0.9em;
}
.slmodule table {
border-collapse: collapse;
width: 100%;
}
.slmodule table th {
padding: 0.2em 12px;
text-align: left;
white-space: nowrap;
width: 100%;
background-color: #ccc;
border-bottom: 1px solid #aaa;
color: #333;
}
.slmodule table td {
overflow: hidden;
padding: 0.2em 12px;
vertical-align: top;
white-space: nowrap;
border-bottom: 1px dotted #ccc;
}

ul#tabnav { /* general settings */
text-align: left; /* set to left, right or center */
margin: 1em 0 1em 0; /* set margins as desired */
font: bold 11px verdana, arial, sans-serif; /* set font as desired */
border-bottom: 1px solid #666; /* set border COLOR as desired */
list-style-type: none;
padding: 3px 10px 3px 10px; /* THIRD number must change with respect to padding-top (X) below */
}

ul#tabnav li { /* do not change */
display: inline;
}

ul.t1s li.tab1, ul.t2s li.tab2 { /* settings for selected tab */
border-bottom: 1px solid #fff; /* set border color to page background color */
background-color: #fff !important; /* set background color to match above border color */
}

ul.t1s li.tab1 a, ul.t2s li.tab2 a { /* settings for selected tab link */
background-color: #fff !important; /* set selected tab background color as desired */
border-bottom: 1px solid #fff !important;
color: #000; /* set selected tab link color as desired */
padding-top: 4px; /* must change with respect to padding (X) above and below */
}

ul#tabnav li a { /* settings for all tab links */
padding: 3px 4px; /* set tab size; FIRST number must change with respect to padding-top (X) above */
border: 1px solid #666; /* set border COLOR as desired; usually matches border color specified in #tabnav */
background-color: #ddd; /* set unselected tab background color as desired */
color: #666; /* set unselected tab link color as desired */
margin-right: 4px; /* set additional spacing between tabs as desired */
position: relative;
text-decoration: none;
top: 1px !important;
}

ul#tabnav a:hover { /* settings for hover effect */
background: #fff; /* set desired hover color */
}


</style>';
?>
