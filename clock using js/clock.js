setInterval(() => {
	d = new Date();
	htime = d.getHours();
	mtime = d.getMinutes();
	stime = d.getSeconds();
	hour_rotate = 30* htime + mtime/2;
	minute_rotate = 6*mtime;
	second_rotate = 6*stime;

	hour.style.transform = `rotate(${hour_rotate}deg)`;
	minute.style.transform = `rotate(${minute_rotate}deg)`;
	second.style.transform = `rotate(${second_rotate}deg)`;
}, 1000);
