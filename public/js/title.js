
window.onload = function()
{
	var title = $('#the_title')[0].getAttribute('data');
	// console.log(title)
	for(var i_1 = 0;i_1<$('.a-nav-side').length;i_1++)
	{
		if($('.a-nav-side')[i_1].getAttribute('data')==title)
		{
			$($('.a-nav-side')[i_1]).addClass('active')
			if($($('.a-nav-side')[i_1]).attr('aria-expanded'))
			{
				$($('.a-nav-side')[i_1]).attr('aria-expanded','true')
				$($('.a-nav-side')[i_1]).click()
				a_list = $('.a-list');
				for(var ii=0;ii<a_list.length;ii++)
				{
					if(document.location.href==$(a_list[ii]).attr('href'))
						$(a_list[ii]).addClass('active')
				}
			}
		}
	}

}