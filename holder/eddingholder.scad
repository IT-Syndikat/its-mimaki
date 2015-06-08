module eddingholder() {
difference() {
	union() {	
		cylinder(h=50, d=11.5);
		translate([-5.75,0,0]) cube([11.5,30,5]);
		translate([0,30,0]) cylinder(h=30, d=20);
		translate([2,38,0]) cube([2,8,30]);
		translate([-4,38,0]) cube([2,8,30]);
		}
	translate([0,30,-1]) cylinder(h=32, d=15);
	translate([-2,35,-1]) cube([4,10,40]);
	translate([-15,42,25]) rotate([90,0,90]) cylinder(h=30, d=3);
	translate([-15,42,15]) rotate([90,0,90]) cylinder(h=30, d=3);
	translate([-15,42,5]) rotate([90,0,90]) cylinder(h=30, d=3);
	}
}
eddingholder();
