package main

import (
	"net/http"
	"io"
	"os"
	"os/exec"
)

const upload_form = `<html>
<body>
<a href="https://wiki.it-syndikat.org/index.php/Mimaki_CG-61_Vinyl_Cutter" target="_blank">MANUAL</a>
<hr />
<form method="post" enctype="multipart/form-data">
<input type="file" name="file" /><br />
<input type="checkbox" name="scale">apply additional scaling (inkscape < v0.90)</input><br />
<input type="submit" value="plot" />
</form>
</body>
</html>`

func index(w http.ResponseWriter, r *http.Request) {
	if r.Method == "POST" {
		// uploaded file
		file, _, err := r.FormFile("file")
		if err != nil {
			w.Write([]byte(err.Error()))
			return
		}
		defer file.Close()

		// plotter
		lp0, err := os.Create("/dev/usb/lp0")
		if err != nil {
			w.Write([]byte(err.Error()))
			return
		}
		defer lp0.Close()

		if r.FormValue("scale") == "on" {
			hpgltrans := exec.Command("/opt/mimaki/HPGLtrans/HPGLtrans", "-S", "1.24023")
			hpgltrans.Stdin = file
			hpgltrans.Stdout = lp0
			hpgltrans.Run()
		} else {
			io.Copy(lp0, file)
		}
	}
	w.Write([]byte(upload_form))
}

func main() {
	http.HandleFunc("/", index)
	http.ListenAndServe(":80", nil)
}
