module penholder() {
	rotate([0,90,0])
		difference() {
			union() {
			cylinder(h=50, d=11.5);
			translate([0,0,27.5]) cylinder(h=1.8, d=16.5);
			}
		translate([0,0,-1]) cylinder(h=52, d=3);
		translate([0,-15,-1]) cube([50,30,52]);	
		}
	}

penholder();
translate([0,20,0]) penholder();
