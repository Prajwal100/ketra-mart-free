$('#basic').flagStrap();

$('.select-country').flagStrap({
	countries: {
		"US": "USD",
		"AU": "AUD",
		"CA": "CAD",
		"SG": "SGD",
		"GB": "GBP",
	},
	buttonSize: "btn-sm",
	buttonType: "btn-outline-none",
	labelMargin: "10px",
	scrollable: false,
	scrollableHeight: "350px"
});
