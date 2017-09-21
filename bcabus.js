function move(direction, steps){
	var j = {'l':4, 'r':0, 'd':6, 'u':2};
	for (var x = steps; x > 0; x--){
		g(j[direction]);
	console.log('hello');
	}

	return 1;
}

function g(d){
	setTimeout(api("action", {
		type: "move",
		direction: d
	}), 1000);
}
