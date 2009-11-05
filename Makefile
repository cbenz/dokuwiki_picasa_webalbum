all:
	cp orig/jquery.pwi.js .
	patch < orig/jquery.pwi.js.patch
	cp orig/jquery.slimbox2.css .
	patch < orig/jquery.slimbox2.css.patch
	rm style.css
	cat *.css > style.css
