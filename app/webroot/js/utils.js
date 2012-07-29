/*
* 03/Mar/10 - Se reduce la animación de aparición de los tips a un tween de opacidad.
* 14/Abr/11 - Modo 'cancel' para las animaciones de los tips, agregado un delay.
*/

//// 
new SmoothScroll({ duration:1500,transition:Fx.Transitions.Quint.easeInOut }, window);
$$('input[type=password]').each(function(el){ el.set('autocomplete','off'); });

$$('.cuteCheckbox').addClass('cuteCheckboxInit');
$$('.cuteCheckboxInit input[type=checkbox]').each(function(el){
	var label = $$('label[for='+el.get('id')+']');
	
	if(!label)
		return false;

	if(el.checked){
		label.addClass('checked');
	}else{
		label.removeClass('checked');
	}
		
	el.addEvent('click',function(e){
		var ev = new Event(e);
		var chk = ev.target;
		
		if(chk.checked){
			this.addClass('checked');
		}else{
			this.removeClass('checked');
		}
		
	}.bind(label));
});

////

	formtips = new Tips('.formtipCaller',{
		className : 'formtip tooltip',
		offsets:{'x':5,'y':5},
		showDelay:0,
		hideDelay:0,
		fixed:true,
		onShow: function(el,caller){ // En Moo 1.2.4 se requiere hackear/agregar el segundo param dentro del more.
			var el_ = el.getCoordinates();
			var cal_ = caller.getCoordinates();

			var title = el.getElement('.tip-title');
			if(title.get('html')=='') title.setStyle('display','none');

			this.options.offset.y = -(el_.height);
			this.options.offset.x = ((el_.width - cal_.width)/-2).toInt();
			
			if(el.getStyle('opacity') > 0) // Reinicia el opacity cuando se posiciona sobre un nuevo input y el tip de otro aún está visible
				el.setStyle('opacity',0);
			
			el.set('tween',{ duration:300, link:'cancel', property:'opacity', transition:'pow:out' }).tween(.8);
		},
		onHide: function(el){
			if(el.getStyle('opacity') > 0)
				el.tween(0);
		}
	});

	////
	myTips = new Tips('.tipCaller',{
		className : 'tooltip',
		offsets:{'x':16,'y':8},
		showDelay:150,
		hideDelay:0,
		fixed:false,
		onShow: function(el){
			var title = el.getElement('.tip-title');
			if(title.get('html')=='') title.setStyle('display','none');
			el.set('morph',{ duration:300, link:'cancel', transition:'pow:out' }).morph({ 'margin-top':[-25,0], 'opacity':[0,1] });
		},
		onHide: function(el){ if(el.getStyle('opacity') > 0) el.morph({ 'margin-top':[0,-25], 'opacity':[1,0] }); }

	});

function mooPop(msg){

	var pop_txt = msg.indexOf('#') == 0 ? $(msg.substr(1)).setStyle('display','none').get('html') : msg;
	var pop = new Element('div',{ 'class':'mooPop'}).adopt(
		new Element('div',{ 'class':'mooPopWrap'}).adopt([
			new Element('a',{ href:'javascript:;','class':'mooPopClose',html:'Cerrar', events:{ click:function(){ this.getParent('.mooPop').nix(); }}}),
			new Element('div',{'class':'mooPopMsg', html:pop_txt.replace('. ','<br/>')})
		])
	).inject(document.body);

	pop.makeDraggable();
	var pop_size = pop.getSize();
	pop.set('reveal',{duration:900,transition: 'quint:out' }).setStyles({
		display:'none',
		top:((window.getScrollTop()+window.getHeight()-pop_size.y)/2).toInt(),
		left:((window.getScrollLeft()+window.getWidth()-pop_size.x)/2).toInt()
	}).reveal();
}

function facebook_fade(mode,el,destroyable){
	destroyable = destroyable || true;
	if(mode){
		el.setStyle('opacity',0);
		new Fx.Slide(el,{
			link:'chain',
			duration: 400,
			transition:Fx.Transitions.Quint.easeInOut
		}).slideIn().chain(function(){
			el.tween('opacity',1);
		});
	} else{
		el.fade('out').get('tween').chain(function(){
			new Fx.Slide(el,{
				link:'chain',
				duration: 400,
				transition:Fx.Transitions.Quint.easeInOut
			}).slideOut().chain(function(){
				if(destroyable) el.getParent().destroy(); //Destruye el div creado para el slide
			});
		});
	}
}

function tbAddRow(tabla,data,attbts){
	attbts = attbts || {};
	fila = new Element('tr',attbts);
	
	for(var i=0;i<data.length;i++){
		switch(_getType(data[i])){
		case 'string':
			new Element('td',{ html:data[i] }).inject(fila);
			break;
			
		case 'array':	
			celda = new Element('td');
			for(var j=0;j<data[i].length;j++){
				if(_getType(data[i])=='string')
					celda.set('html',data[i][j]);
				else
					celda.inject(data[i][j]);
			}
			break;
			
		case 'object':
			data[i].inject(new Element('td').inject(fila));
			break;
		}
	}
	fila.inject(tabla.getElement('tbody'));
	return fila;
}

//== CORE EXTENSION ====================================

var _getType = function(inp) {
	var type = typeof inp, match; var key;
	
	if (type == 'object' && !inp) return 'null';
	if (type == "object") {
		if (!inp.constructor) return 'object';

		var cons = inp.constructor.toString();
		if (match = cons.match(/(\w+)\(/)) cons = match[1].toLowerCase();

		var types = ["boolean", "number", "string", "array"];

		for(key in types) {
			if (cons == types[key]) { type = types[key]; break; }
		}
	}
	return type;
};