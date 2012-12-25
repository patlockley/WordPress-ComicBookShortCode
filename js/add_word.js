function add_word(){

	document.getElementById("content_ifr").contentWindow.document.body.innerHTML += "[comicbookshortcode word='" + document.getElementById("word").value + 
																					"' size='" + document.getElementById("size").value + 
																					"' wcolor='" + document.getElementById("wcolor").value + 
																					"' fill='" + document.getElementById("main").value + 
																					"' outline='" + document.getElementById("outline").value + 
																					"']";

}