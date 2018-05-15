# ITS Mimaki Vinylcutter

Maintainers: 
        
* Software:                     tyrolyean
* Hardware:                     gwrx
* Mental Breakdowns:            W4RH4WK


## About

These scripts are used for our vinylcutter "mimaki". It basically writes the
hpgl files it gets to the device the cutter is conected at. And it, less 
basically and more precisely, is able to scale hpgl files with a predefined
factor for an old version of inkscape, (which probably doesn't even exist on
any laptop anymore), which doesn't use the scaling function of HPGL because
the plotter probably isn't able to execute it (this is untested) and which
is capable of crashing on a too slow raspberry pi if php isn't configured to
let the script run for more than 30 seconds.

## Requirements

It only requires a http server which is able to execute php scripts. The
user, which the script is run as, needs to be able to acces the device the
plotter is connected at.
