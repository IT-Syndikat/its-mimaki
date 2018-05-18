# ITS Mimaki Vinylcutter

Maintainers: 
        
* Software:                     tyrolyean
* Hardware:                     gwrx
* Mental Breakdowns:            W4RH4WK


## About

These scripts are used for our vinylcutter "mimaki". It basically writes the
hpgl files it gets to the device the cutter is conected at. And it, less 
basically and more precisely, is able to: scale hpgl files with a predefined
factor for an old version of inkscape (which probably doesn't even exist on
any distro anymore); which doesn't use the scaling function of HPGL because
the plotter probably isn't able to execute it (this is untested); and which
is capable of crashing on a too slow raspberry pi if php isn't configured to
let the script run for more than 30 seconds.

Please try to run this script on something faster than a raspberry pi of the
first generation.

## Requirements

It only requires a http server which is able to execute php scripts. The
user, which the script is run as, needs to be able to acces the device the
plotter is connected at.

## History

Previously this repository contained a go script and a python file which pretty
much did the same things the php scripts which currently reside in this
repository. One day it was noticed that the plotter isn't printing whole files
anymore, but rather stopped at random times. After investigating the problem
further, it was discovered that the usb to parallel adapter disconected and
reconected precisely every 5 seconds. As a consequence the raspberry pi 
became a new os. The disconnects were gone, but the go script behaved strangely,
and produced the same errors. As an intermediate solution a quick php script
was written and uploaded to this repository. It was requested that the, by then,
very small php script would be updated to support the scaling function of the
go script.
