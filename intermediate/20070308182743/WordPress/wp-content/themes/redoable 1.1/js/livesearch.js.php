
Livesearch = Class.create();

Livesearch.prototype = {
	initialize: function(searchform, attachitem, targetitem, hideitem, url, pars, loaditem, searchtext, resetbutton, submitbutton, buttonvalue, resultposition) {
		var thisSearch = this;

		this.searchform = searchform;
		this.attachitem = attachitem;
		this.targetitem = targetitem;
		this.hideitem = hideitem;
		this.url = url;
		this.pars = pars;
		this.loaditem = loaditem;
		this.searchtext = searchtext;
		this.resetbutton = resetbutton;
		this.submitbutton = submitbutton;
		this.buttonvalue = buttonvalue;
		this.searchstring = '';
		this.t = null;  // Init timeout variable
		
		this.resultposition = resultposition;
		this.hidesidenote = "leftcolumn";
		this.hidecomment = "comment-block";

		if(0) {
			$(this.searchform).innerHTML = '<input type="search" results="5" autosave="com.domain.search" id="'+this.attachitem+'" name="'+this.attachitem+'" class="livesearch" autocomplete="off" value="" /><span id="'+this.resetbutton+'"></span><span id="'+this.loaditem+'"></span><input type="submit" id="'+this.submitbutton+'" value="'+this.buttonvalue+'" />';
		} else {
			$(this.searchform).innerHTML = '<input type="text" id="'+this.attachitem+'" name="'+this.attachitem+'" class="livesearch" autocomplete="off" value="'+this.searchtext+'" /><span id="'+this.resetbutton+'"></span><span id="'+this.loaditem+'"></span><input type="submit" id="'+this.submitbutton+'" value="'+this.buttonvalue+'" />';
		}
		
		$(this.submitbutton).style.display = "none";
		$(this.loaditem).style.display = "none";
		new Effect.Fade(this.resetbutton, { duration: 0, to: 0.3 });

		Event.observe(thisSearch.attachitem, 'focus', function() {
			if ($F(thisSearch.attachitem) == thisSearch.searchtext)
				$(thisSearch.attachitem).setAttribute('value', '');
		});

		Event.observe(thisSearch.attachitem, 'blur', function() {
			if ($F(thisSearch.attachitem) == '')
				$(thisSearch.attachitem).setAttribute('value', thisSearch.searchtext);
		});

		// Bind the keys to the input
		Event.observe(this.attachitem, 'keyup', this.readyLivesearch.bindAsEventListener(this));
	},

	readyLivesearch: function(event) {
		var code = event.keyCode;
		if (code == Event.KEY_ESC || ((code == Event.KEY_DELETE || code == Event.KEY_BACKSPACE) && $F(this.attachitem) == '')) {
			this.resetLivesearch.bind(this);
		} else if (code != Event.KEY_RETURN) {
			if (this.t) clearTimeout(this.t);
	        this.t = setTimeout(this.doLivesearch.bind(this), 400);
		}
	},

    doLivesearch: function() {
		if ($F(this.attachitem) == this.searchstring) return;

		new Effect.Fade(this.resetbutton, { duration: 0.1 });
		new Effect.Appear(this.loaditem, { duration: 0.1 });
		
		new Ajax.Updater(
			this.targetitem,
			this.url,
			{
				method: 'get',
				evalScripts: true,
				parameters: this.pars + encodeURIComponent(document.getElementById("s").value) + '&rolling=1',
				onComplete: this.searchComplete.bind(this)
		});
//				parameters: this.pars + encodeURIComponent($F(this.attachitem)) + '&rolling=1',
		this.searchstring = $F(this.attachitem);
	},
	
	searchComplete: function() {
		$(this.hideitem).style.display = 'none';
		
		//added to hide sidenotes or comments by Dean Robinson
		if(document.getElementById(this.hidesidenote) && (this.resultposition == 1) ) { $(this.hidesidenote).style.display = 'none'; }
		if(document.getElementById(this.hidecomment) && (this.resultposition == 1) ) { $(this.hidecomment).style.display = 'none'; }
		//end add
		
		new Effect.Fade(this.loaditem, { duration: 0.1 });
		new Effect.Appear(this.resetbutton, { duration: 0.1 });
		
		Event.observe(this.resetbutton, 'click', this.resetLivesearch.bindAsEventListener(this));
		$(this.resetbutton).style.cursor = 'pointer';

		// Support for Lightbox
		if (window.initLightbox) {
			initLightbox();
		}
	},

	resetLivesearch: function() {
		$(this.targetitem).innerHTML = '';
		$(this.hideitem).style.display = 'block';
		
		//added to show sidenotes or comments by Dean Robinson
		if(document.getElementById(this.hidesidenote) && (this.resultposition == 1) ) { $(this.hidesidenote).style.display = 'block'; }
		if(document.getElementById(this.hidecomment) && (this.resultposition == 1)) { $(this.hidecomment).style.display = 'block'; }
		//end add

		$(this.attachitem).value = this.searchtext;
		new Effect.Fade(this.resetbutton, { duration: 0.1, to: 0.3 });
		$(this.resetbutton).style.cursor = 'default';
	}
}

var lsUrl = window.location.href.match(/^(http:\/\/[^/]+)/)[1]
	+ 'http://austnet.org/WordPress/wp-content/themes/redoable 1.1'.match(/^http:\/\/[^/]+(.+)/)[1];
	
new FastInit( function() { new Livesearch('searchform', 's', 'dynamic-content', 'current-content', lsUrl + '/searchloop.php', '&s=', 'searchload', 'Type and Wait', 'searchreset', 'searchsubmit', 'go', '1'); } );
