# ITS Mimaki Venylcutter

## About

The webserver provided in this repository enables our venylcutter to print
files using a very simple webinterface, hence no printer driver or cable
connection between your laptop and the cutter is required.

There is also an option to apply automatic scaling in case you are using an
older version of inkscape.

## Install

These files are placed on a Raspberry Pi under `/opt/mimaki` except for the
startup script. This will become `/etc/init.d/mimaki`.

In order to run the webserver build the executable using Go.

After moving and building you can start the webservice using:

    # service mimaki start

Use `update-rc.d` to start this service automatically on boot.
