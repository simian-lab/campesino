var owl = $('#slider').owlCarousel({
	afterMove: function(){
		if(owl.currentItem === owl.itemsAmount -1){
			setTimeout(function(){
				owl.jumpTo(1)
			}, owl.options.slideSpeed)
		}

		if(owl.currentItem === 0) {
			setTimeout(function(){
				owl.jumpTo(owl.itemsAmount-2);
			}, owl.options.slideSpeed)
		}
	}
}).data('owlCarousel');

owl.addItem(owl.$owlItems.last().html(), 0);
owl.addItem(owl.$owlItems.eq(1).html(), owl.$owlItems.length);
owl.paginationWrapper.find(".owl-page").first().remove();
owl.paginationWrapper.find(".owl-page").last().remove();
owl.jumpTo(1);