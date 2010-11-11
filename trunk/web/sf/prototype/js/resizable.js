/**
* Classe permettant le redimensionnement d'un élément
* @author Olivier ROGER
* @version 1.0.0
*
*/
Resizable = Class.create();
Resizable.prototype = 
{
	initialize:function(elem)
	{
		this.RsE  = 1;
		this.RsW  = 2;
		this.RsS  = 3;
		this.RsSE = 4;
		this.RsSW = 5;
		//Postion du curseur à l'appel de getCursorPos
		this.curPosX;
		this.curPosY;
		this.curPosXOld;
		this.curPosYOld;
		//A t'on cliqué ?
		this.clicked = false;
		//Element à déplacer
		this.objet = $(elem);
		//Zone dans laquelle on passe en mode resize (px)
		this.resizeZoneH = 8;
		this.resizeZoneV = 8;
		//Taille
		this.initWidth = this.objet.getWidth();
		this.initHeight = this.objet.getHeight();
		this.initLeft	= this.objet.style.left;
		this.minWidth   = 50;
		this.minHeight   = 25;
		//Event
		this.eventMouseDown = this.onDownAction.bindAsEventListener(this);
		this.eventMouseUp = this.onUpAction.bindAsEventListener(this);
		this.eventMouseMove = this.onMoveAction.bindAsEventListener(this);
		Event.observe(document, "mousedown", this.eventMouseDown);
		Event.observe(document, "mouseup", this.eventMouseUp);
		Event.observe(document, "mousemove", this.eventMouseMove);
		this.action;
	},
	
	/**
	* Récupère la position du curseur
	* @param event e
	*/
	getCursorPos:function(e)
	{
		this.curPosX = Event.pointerX(e);
		this.curPosY = Event.pointerY(e);
	},
	
	/**
	* Action lancée à la pression du bouton
	* @param event e
	*/
	onDownAction:function(e)
	{
		this.clicked = true;
		this.initWidth = this.objet.getWidth();
		this.initHeight = this.objet.getHeight();
		this.getCursorPos(e);
		this.curPosXOld = this.curPosX;
		this.curPosYOld = this.curPosY;
		this.action = this.changeCursor(e);	
	},
	
	/**
	* Action lancée au relachement du bouton
	* @param event e
	*/
	onUpAction:function(e)
	{
		this.clicked = false;
		this.initWidth = this.objet.getWidth();
		this.initHeight = this.objet.getHeight();
		this.initLeft	= this.objet.style.left;
	},
	
	/**
	* Action lors du déplacement de la souris
	* @param event e
	*/
	onMoveAction:function(e)
	{
		if(this.clicked)
		{
			this.getCursorPos(e);
			switch(this.action)
			{
				case this.RsE :
					this.resizeE();
				break;
				case this.RsW : 
					this.resizeW();
				break;
				case this.RsS :
					this.resizeS();
				break;
				case this.RsSE :
					this.resizeS();
					this.resizeE();
				break;
				case this.RsSW :
					this.resizeS();
					this.resizeW();
				break;
			}
		}
		else
		{
			this.changeCursor(e);
		}
	},
	
	/**
	* Change le curseur en fonction de sa position
	* @param event e
	* @return int Type du redimensionnement
	*/
	changeCursor:function(e)
	{
		var posX = Event.pointerX(e);
		var posY = Event.pointerY(e);
		
		//Bas droit
		if(posX>((parseInt(this.objet.style.left)+this.objet.getWidth())-this.resizeZoneH) && posX<(parseInt(this.objet.style.left)+this.objet.getWidth())
			&& posY>((parseInt(this.objet.style.top)+this.objet.getHeight())-this.resizeZoneV) && posY<(parseInt(this.objet.style.top)+this.objet.getHeight()))
		{
			this.objet.setStyle({cursor:'se-resize'});
			return this.RsSE;
		}
		//bas gauche
		if(posX>parseInt(this.objet.style.left) && posX<(parseInt(this.objet.style.left)+this.resizeZoneH)
			&& posY>((parseInt(this.objet.style.top)+this.objet.getHeight())-this.resizeZoneV) && posY<(parseInt(this.objet.style.top)+this.objet.getHeight()))
		{
			this.objet.setStyle({cursor:'sw-resize'});
			return this.RsSW;
		}
		
		//Coté droit
		if(posX>((parseInt(this.objet.style.left)+this.objet.getWidth())-this.resizeZoneH) && posX<(parseInt(this.objet.style.left)+this.objet.getWidth()))
		{
			this.objet.setStyle({cursor:'e-resize'});
			return 1;
		}
		
		//Coté gauche
		if(posX>parseInt(this.objet.style.left) && posX<(parseInt(this.objet.style.left)+this.resizeZoneH))
		{
			this.objet.setStyle({cursor:'w-resize'});
			return this.RsW;
		}
		
		//Bas
		if(posY>((parseInt(this.objet.style.top)+this.objet.getHeight())-this.resizeZoneV) && posY<(parseInt(this.objet.style.top)+this.objet.getHeight()))
		{
			this.objet.setStyle({cursor:'s-resize'});
			return this.RsS;
		}
		
		this.objet.setStyle({cursor:'auto'});
		return this.RsE;
		
	},
	
	/**
	* Redimensionne l'objet vers la droite
	*
	*/
	resizeE:function()
	{
		var ecart 		= (parseInt(this.objet.style.left) + this.initWidth)-this.curPosX;
		var newWidth 	= this.initWidth - ecart;
		if(newWidth > this.minWidth)
			this.objet.setStyle({width:newWidth});
	},
	
	/**
	* Redimensionne l'objet vers la gauche
	* 
	*/
	resizeW:function()
	{
		var ecart		= parseInt(this.initLeft) -this.curPosX;
		var newWidth 	= this.initWidth + ecart;
		var newLeft		= this.curPosX;
		if(newWidth > this.minWidth)
			this.objet.setStyle({left:newLeft,width:newWidth});
	},
	
	/**
	* Redimensionne l'objet vers le bas
	* 
	*/
	resizeS:function()
	{
		var ecart 		= (parseInt(this.objet.style.top)+this.initHeight) - this.curPosY;
		var newHeight 	= this.initHeight - ecart; 
		if(newHeight > this.minHeight)
			this.objet.setStyle({height:newHeight});
	}
	
}