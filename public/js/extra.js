



function extraLoaded(){
	var inWidth = $(window).width();
	var inHeight = $(window).height();
	if($('.langWay').length>0)
	{
		if($(window).width() > 1021)
		{
			$('.langWay').css({height:inHeight});
			$('.langWay li .mediaHolder>img').css({
				height: (inHeight / 2) + 2 + 'px'
			});
			$('.langWay li .mediaHolder').css({
				height: (inHeight / 2)
			});
		}
		else if($(window).width() > 767 && $(window).width() <= 1021)
		{
			$('.langWay').css({height:inHeight});
			$('.langWay li .mediaHolder>img').css({
				height: inHeight
			});
			$('.langWay li .mediaHolder').css({
				height: inHeight
			});
		}
		else if($(window).width() < 767)
		{
			$('.langWay').css({height:'auto'});
			$('.langWay li .mediaHolder>img').css({
				height: 'auto'
			});
			$('.langWay li .mediaHolder').css({
				height: 'auto'
			});
		}
	}

	if($('.galDetail .galMedia>img').length>0)
	{
		if($(window).width() > 1021)
		{
			$('.galDetail .galMedia>img').css({height:inHeight});
		}
		else if($(window).width() > 769 && $(window).width() <= 1021)
		{
			$('.galDetail .galMedia>img').css({height:inHeight});
		}
		else
		{
			$('.galDetail .galMedia>img').css({height:'auto'});
		}
	}

	if($('.galDetail').length>0)
	{
		if ($(window).width() >= 769)
		{
			$('.galDetail .galSide').css({
				height: (inHeight)
			});
		}
	}

	if($('.galDetail').length>0)
	{
		if ($(window).width() >= 769)
		{
			$('#fadeMe').bjqs({
				height      : $(window).height(),
				width       : 'auto',
				responsive  : true,
				automatic   : false,
				showmarkers : false,
				usecaptions : false,
				nexttext    : '',
				prevtext    : ''
			});
		}
	}


}


		function risizer(){
			var inWidth = $(window).width();
			var inHeight = $(window).height();
			if($('.langWay').length>0)
			{
				if($(window).width() > 1021)
				{
					$('.langWay').css({height:inHeight});
					$('.langWay li .mediaHolder>img').css({
						height: (inHeight / 2) + 2 + 'px'
					});
					$('.langWay li .mediaHolder').css({
						height: (inHeight / 2)
					});
				}
				else if($(window).width() > 767 && $(window).width() <= 1021)
				{
					$('.langWay').css({height:inHeight});
					$('.langWay li .mediaHolder>img').css({
						height: inHeight
					});
					$('.langWay li .mediaHolder').css({
						height: inHeight
					});
				}
				else
				{
					$('.langWay').css({height:'auto'});
					$('.langWay li .mediaHolder>img').css({
						height: 'auto'
					});
					$('.langWay li .mediaHolder').css({
						height: 'auto'
					});
				}
			}

			if($('.galDetail .galMedia>img').length>0)
			{
				if($(window).width() > 1021)
				{
					$('.galDetail .galMedia>img').css({height:inHeight});
				}
				else if($(window).width() > 767 && $(window).width() <= 1021)
				{
					$('.galDetail .galMedia>img').css({height:inHeight});
				}
				else
				{
					$('.galDetail .galMedia>img').css({height:'auto'});
				}
			}

		};
		window.onresize=risizer;