	function HTML(){
		var _$ = jQuery;
		self = this;
		self.table = function(options){
			var structure = _$.extend({
				Attrs:{},
				Titles: [],
				rows: []
			}, options);
			console.log(structure.Titles);
			var titles = self.createElem("tr");
			for(var i in structure.Titles) {
				titles.append(self.createElem("th", {}, structure.Titles[i]));
			}
			var table = self.createElem("table", structure.Attrs, self.createElem("thead", {}, titles));
			var tbody = self.createElem("tbody");
			for(var i in structure.rows){
				var row = self.table.row(structure.rows[i].Attrs, structure.rows[i].Columns)
				tbody.append(row);
			}
			table.append(tbody);
			tbody  = null;
			titles = null;
			row    = null;
			return table;
		};

		self.table.row = function(attrs, columns){
			var row = self.createElem("tr", attrs);
			for (var i in columns){
				row.append(self.table.column(columns[i].Attrs, columns[i].Value))
			}
			return row
		}

		self.table.column = function(attrs, value){
			return self.createElem("td", attrs, value)
		}

		self.link = function(attrs, href, value){
			attrs = _$.extend({href: href}, attrs);
			return self.createElem("a", attrs, value);
		};

		self.input = function(attrs, value, type){
			attrs = _$.extend({type: type, value: value}, attrs);
			return self.createElem("input", attrs);
		}

		self.input.hidden = function(value, name, attrs){
			attrs = _$.extend({
				name: name
			}, attrs);
			return self.input(attrs, value, "hidden");
		}

		self.input.select = function(attrs, name, options){
			attrs = _$.extends({
				name: name
			}, attrs);
			options = options || [];
			var select = self.createElem("select", attrs);
			for(var i in options){
				select.append(new Option(options[i].html, options[i].val));
			}
			return select;
		}

		self.div = function(attrs, val){
			return self.createElem("div", attrs, val);
		}

		self.createElem = function(name, attributes, val){
			val = typeof val !== "undefined" ? val : "";
			attributes = typeof attributes !== "undefined" ? attributes : {};
			return _$("<"+ name +">").attr(attributes).html(val);
		};
	};
	window.Html = new HTML();