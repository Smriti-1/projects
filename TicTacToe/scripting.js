$(document).ready(function () {
	var move = 1;
	var play = true;
	$("table tr td").click(function () {
		if ($(this).text() == "" && play) {
			if (move % 2 == 1) {
				$(this).append("X");
				$(this).css("color", "green");
			} else {
				$(this).append("O");
				$(this).css("color", "red");
			}

			move++;
			if (winner() !== -1 && winner() != "") {
				if (winner() == "X") {
					$("body").append(
						"<div class='winner'><span> Winner </span> &#9996 X</div>"
					);
					$("body").append(
						'<button onclick="location.reload()">&#10226 PLAY AGAIN</button>'
					);
				} else {
					$("body").append(
						"<div class='winner'><span> Winner </span>&#9996 O</div>"
					);
					$("body").append(
						'<button onclick="location.reload()">&#10226 PLAY AGAIN</button>'
					);
				}
				play = false;
			}
		}
	});

	function winner() {
		var sp1 = $(".1").text();
		var sp2 = $(".2").text();
		var sp3 = $(".3").text();
		var sp4 = $(".4").text();
		var sp5 = $(".5").text();
		var sp6 = $(".6").text();
		var sp7 = $(".7").text();
		var sp8 = $(".8").text();
		var sp9 = $(".9").text();
		//  rows
		if (sp1 == sp2 && sp2 == sp3) {
			return sp1;
		} else if (sp4 == sp5 && sp5 == sp6) {
			return sp4;
		} else if (sp7 == sp8 && sp8 == sp9) {
			return sp7;
		}
		// columns
		else if (sp1 == sp4 && sp4 == sp7) {
			return sp7;
		} else if (sp2 == sp5 && sp5 == sp8) {
			return sp8;
		} else if (sp3 == sp6 && sp6 == sp9) {
			return sp9;
		}
		// diagonlas
		else if (sp1 == sp5 && sp5 == sp9) {
			return sp9;
		} else if (sp3 == sp5 && sp5 == sp7) {
			return sp7;
		}
		return -1;
	}

	function reset() {
		clearInterval("table");
		$("body").append(
            '<button onclick="location.reload()">PLAY AGAIN</button>'
        );
	}
});
