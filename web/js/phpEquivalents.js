function ucfirst( str ) {
    // http://kevin.vanzonneveld.net
    // + original by: Kevin van Zonneveld (http://kevin.vanzonneveld.net)
    // + bugfixed by: Onno Marsman
    // + improved by: Brett Zamir (http://brettz9.blogspot.com)
    // * example 1: ucfirst('kevin van zonneveld');
    // * returns 1: 'Kevin van zonneveld'
 
    str += '';
    var f = str.charAt(0).toUpperCase();
    return f + str.substr(1);
}

function sprintf( ) {
    // http://kevin.vanzonneveld.net
    // + original by: Ash Searle (http://hexmen.com/blog/)
    // + namespaced by: Michael White (http://getsprink.com)
    // + tweaked by: Jack
    // + improved by: Kevin van Zonneveld (http://kevin.vanzonneveld.net)
    // + input by: Paulo Ricardo F. Santos
    // + improved by: Kevin van Zonneveld (http://kevin.vanzonneveld.net)
    // + input by: Brett Zamir (http://brettz9.blogspot.com)
    // + improved by: Kevin van Zonneveld (http://kevin.vanzonneveld.net)
    // * example 1: sprintf("%01.2f", 123.1);
    // * returns 1: 123.10
    // * example 2: sprintf("[%10s]", 'monkey');
    // * returns 2: '[ monkey]'
    // * example 3: sprintf("[%'#10s]", 'monkey');
    // * returns 3: '[####monkey]'
 
    var regex = /%%|%(\d+\$)?([-+\'#0 ]*)(\*\d+\$|\*|\d+)?(\.(\*\d+\$|\*|\d+))?([scboxXuidfegEG])/g;
    var a = arguments, i = 0, format = a[i++];
 
    // pad()
    var pad = function(str, len, chr, leftJustify) {
        if (!chr) chr = ' ';
        var padding = (str.length >= len) ? '' : Array(1 + len - str.length >>> 0).join(chr);
        return leftJustify ? str + padding : padding + str;
    };
 
    // justify()
    var justify = function(value, prefix, leftJustify, minWidth, zeroPad, customPadChar) {
        var diff = minWidth - value.length;
        if (diff > 0) {
            if (leftJustify || !zeroPad) {
                value = pad(value, minWidth, customPadChar, leftJustify);
            } else {
                value = value.slice(0, prefix.length) + pad('', diff, '0', true) + value.slice(prefix.length);
            }
        }
        return value;
    };
 
    // formatBaseX()
    var formatBaseX = function(value, base, prefix, leftJustify, minWidth, precision, zeroPad) {
        // Note: casts negative numbers to positive ones
        var number = value >>> 0;
        prefix = prefix && number && {'2': '0b', '8': '0', '16': '0x'}[base] || '';
        value = prefix + pad(number.toString(base), precision || 0, '0', false);
        return justify(value, prefix, leftJustify, minWidth, zeroPad);
    };
 
    // formatString()
    var formatString = function(value, leftJustify, minWidth, precision, zeroPad, customPadChar) {
        if (precision != null) {
            value = value.slice(0, precision);
        }
        return justify(value, '', leftJustify, minWidth, zeroPad, customPadChar);
    };
 
    // doFormat()
    var doFormat = function(substring, valueIndex, flags, minWidth, _, precision, type) {
        var number;
        var prefix;
        var method;
        var textTransform;
        var value;
 
        if (substring == '%%') return '%';
 
        // parse flags
        var leftJustify = false, positivePrefix = '', zeroPad = false, prefixBaseX = false, customPadChar = ' ';
        var flagsl = flags.length;
        for (var j = 0; flags && j < flagsl; j++) switch (flags.charAt(j)) {
            case ' ': positivePrefix = ' '; break;
            case '+': positivePrefix = '+'; break;
            case '-': leftJustify = true; break;
            case "'": customPadChar = flags.charAt(j+1); break;
            case '0': zeroPad = true; break;
            case '#': prefixBaseX = true; break;
        }
 
        // parameters may be null, undefined, empty-string or real valued
        // we want to ignore null, undefined and empty-string values
        if (!minWidth) {
            minWidth = 0;
        } else if (minWidth == '*') {
            minWidth = +a[i++];
        } else if (minWidth.charAt(0) == '*') {
            minWidth = +a[minWidth.slice(1, -1)];
        } else {
            minWidth = +minWidth;
        }
 
        // Note: undocumented perl feature:
        if (minWidth < 0) {
            minWidth = -minWidth;
            leftJustify = true;
        }
 
        if (!isFinite(minWidth)) {
            throw new Error('sprintf: (minimum-)width must be finite');
        }
 
        if (!precision) {
            precision = 'fFeE'.indexOf(type) > -1 ? 6 : (type == 'd') ? 0 : void(0);
        } else if (precision == '*') {
            precision = +a[i++];
        } else if (precision.charAt(0) == '*') {
            precision = +a[precision.slice(1, -1)];
        } else {
            precision = +precision;
        }
 
        // grab value using valueIndex if required?
        value = valueIndex ? a[valueIndex.slice(0, -1)] : a[i++];
 
        switch (type) {
            case 's': return formatString(String(value), leftJustify, minWidth, precision, zeroPad, customPadChar);
            case 'c': return formatString(String.fromCharCode(+value), leftJustify, minWidth, precision, zeroPad);
            case 'b': return formatBaseX(value, 2, prefixBaseX, leftJustify, minWidth, precision, zeroPad);
            case 'o': return formatBaseX(value, 8, prefixBaseX, leftJustify, minWidth, precision, zeroPad);
            case 'x': return formatBaseX(value, 16, prefixBaseX, leftJustify, minWidth, precision, zeroPad);
            case 'X': return formatBaseX(value, 16, prefixBaseX, leftJustify, minWidth, precision, zeroPad).toUpperCase();
            case 'u': return formatBaseX(value, 10, prefixBaseX, leftJustify, minWidth, precision, zeroPad);
            case 'i':
            case 'd': {
                number = parseInt(+value);
                prefix = number < 0 ? '-' : positivePrefix;
                value = prefix + pad(String(Math.abs(number)), precision, '0', false);
                return justify(value, prefix, leftJustify, minWidth, zeroPad);
            }
            case 'e':
            case 'E':
            case 'f':
            case 'F':
            case 'g':
            case 'G': {
                number = +value;
                prefix = number < 0 ? '-' : positivePrefix;
                method = ['toExponential', 'toFixed', 'toPrecision']['efg'.indexOf(type.toLowerCase())];
                textTransform = ['toString', 'toUpperCase']['eEfFgG'.indexOf(type) % 2];
                value = prefix + Math.abs(number)[method](precision);
                return justify(value, prefix, leftJustify, minWidth, zeroPad)[textTransform]();
            }
            default: return substring;
        }
    };
 
    return format.replace(regex, doFormat);
}

function chr (codePt) {
    // Converts a codepoint number to a character
    // 
    // version: 909.322
    // discuss at: http://phpjs.org/functions/chr // + original by: Kevin van
	// Zonneveld (http://kevin.vanzonneveld.net)
    // + improved by: Brett Zamir (http://brett-zamir.me)
    // * example 1: chr(75);
    // * returns 1: 'K'
    // * example 1: chr(65536) === '\uD800\uDC00'; // * returns 1: true
    
    if (codePt > 0xFFFF) { // Create a four-byte string (length 2) since this
							// code point is high
                                             // enough for the UTF-16
												// encoding (JavaScript internal
												// use), to
                                             // require representation with
												// two surrogates (reserved
												// non-characters // used for
												// building other characters;
												// the first is "high" and the
												// next "low")
        codePt -= 0x10000;
        return String.fromCharCode(0xD800 + (codePt >> 10), 0xDC00 + (codePt & 0x3FF));
    }
    else {        return String.fromCharCode(codePt);
    }
}

function ord (string) {
    // Returns the codepoint value of a character
    // 
    // version: 909.322
    // discuss at: http://phpjs.org/functions/ord // + original by: Kevin van
	// Zonneveld (http://kevin.vanzonneveld.net)
    // + bugfixed by: Onno Marsman
    // + improved by: Brett Zamir (http://brett-zamir.me)
    // * example 1: ord('K');
    // * returns 1: 75 // * example 2: ord('\uD800\uDC00'); // surrogate pair to
	// create a single Unicode character
    // * returns 2: 65536
    var str = string + '';
    
    var code = str.charCodeAt(0);    if (0xD800 <= code && code <= 0xDBFF) { // High
																				// surrogate
																				// (could
																				// change
																				// last
																				// hex
																				// to
																				// 0xDB7F
																				// to
																				// treat
																				// high
																				// private
																				// surrogates
																				// as
																				// single
																				// characters)
        var hi = code;
        if (str.length === 1) {
            return code; // This is just a high surrogate with no following
							// low surrogate, so we return its value;
                                    // we could also throw an error as it is not
									// a complete character, but someone may
									// want to know
        }
        var low = str.charCodeAt(1);
        if (!low) {
            
        }        return ((hi - 0xD800) * 0x400) + (low - 0xDC00) + 0x10000;
    }
    if (0xDC00 <= code && code <= 0xDFFF) { // Low surrogate
        return code; // This is just a low surrogate with no preceding high
						// surrogate, so we return its value;
                                // we could also throw an error as it is not a
								// complete character, but someone may want to
								// know
    }
    return code;
}

function explode (delimiter, string, limit) {
    // Splits a string on string separator and return array of components. If
	// limit is positive only limit number of components is returned. If limit
	// is negative all components except the last abs(limit) are returned.
    // 
    // version: 1004.2122
    // discuss at: http://phpjs.org/functions/explode // + original by: Kevin
	// van Zonneveld (http://kevin.vanzonneveld.net)
    // + improved by: kenneth
    // + improved by: Kevin van Zonneveld (http://kevin.vanzonneveld.net)
    // + improved by: d3x
    // + bugfixed by: Kevin van Zonneveld (http://kevin.vanzonneveld.net) // *
	// example 1: explode(' ', 'Kevin van Zonneveld');
    // * returns 1: {0: 'Kevin', 1: 'van', 2: 'Zonneveld'}
    // * example 2: explode('=', 'a=bc=d', 2);
    // * returns 2: ['a', 'bc=d']
     var emptyArray = { 0: '' };
    
    // third argument is not required
    if ( arguments.length < 2 ||
        typeof arguments[0] == 'undefined' ||        typeof arguments[1] == 'undefined' ) {
        return null;
    }
 
    if ( delimiter === '' ||        delimiter === false ||
        delimiter === null ) {
        return false;
    }
     if ( typeof delimiter == 'function' ||
        typeof delimiter == 'object' ||
        typeof string == 'function' ||
        typeof string == 'object' ) {
        return emptyArray;    }
 
    if ( delimiter === true ) {
        delimiter = '1';
    }    
    if (!limit) {
        return string.toString().split(delimiter.toString());
    } else {
        // support for limit argument var splitted =
		// string.toString().split(delimiter.toString());
        var partA = splitted.splice(0, limit - 1);
        var partB = splitted.join(delimiter.toString());
        partA.push(partB);
        return partA;    }
}

function implode (glue, pieces) {
    // Joins array elements placing glue string between items and return one
	// string
    // 
    // version: 1004.2122
    // discuss at: http://phpjs.org/functions/implode // + original by: Kevin
	// van Zonneveld (http://kevin.vanzonneveld.net)
    // + improved by: Waldo Malqui Silva
    // + improved by: Itsacon (http://www.itsacon.net/)
    // + bugfixed by: Brett Zamir (http://brett-zamir.me)
    // * example 1: implode(' ', ['Kevin', 'van', 'Zonneveld']); // * returns 1:
	// 'Kevin van Zonneveld'
    // * example 2: implode(' ', {first:'Kevin', last: 'van Zonneveld'});
    // * returns 2: 'Kevin van Zonneveld'
    var i = '', retVal='', tGlue='';
    if (arguments.length === 1) {        pieces = glue;
        glue = '';
    }
    if (typeof(pieces) === 'object') {
        if (pieces instanceof Array) {            return pieces.join(glue);
        }
        else {
            for (i in pieces) {
                retVal += tGlue + pieces[i];                tGlue = glue;
            }
            return retVal;
        }
    }    else {
        return pieces;
    }
}

function end ( arr ) {
    // Advances array argument's internal pointer to the last element and return
	// it
    // 
    // version: 1004.2314
    // discuss at: http://phpjs.org/functions/end // + original by: Kevin van
	// Zonneveld (http://kevin.vanzonneveld.net)
    // + bugfixed by: Legaev Andrey
    // + revised by: J A R
    // + improved by: Kevin van Zonneveld (http://kevin.vanzonneveld.net)
    // + restored by: Kevin van Zonneveld (http://kevin.vanzonneveld.net) // +
	// revised by: Brett Zamir (http://brett-zamir.me)
    // % note 1: Uses global: php_js to store the array pointer
    // * example 1: end({0: 'Kevin', 1: 'van', 2: 'Zonneveld'});
    // * returns 1: 'Zonneveld'
    // * example 2: end(['Kevin', 'van', 'Zonneveld']); // * returns 2:
	// 'Zonneveld'
    
    // BEGIN REDUNDANT
    this.php_js = this.php_js || {};
    this.php_js.pointers = this.php_js.pointers || [];    var indexOf = function (value) {
        for (var i = 0, length=this.length; i < length; i++) {
            if (this[i] === value) {
                return i;
            }        }
        return -1;
    };
    // END REDUNDANT
    var pointers = this.php_js.pointers;    if (!pointers.indexOf) {
        pointers.indexOf = indexOf;
    }
    if (pointers.indexOf(arr) === -1) {
        pointers.push(arr, 0);    }
    var arrpos = pointers.indexOf(arr);
    if (!(arr instanceof Array)) {
        var ct = 0;
        for (var k in arr) {            ct++;
            var val = arr[k];
        }
        if (ct === 0) {
            return false; // Empty
        }
        pointers[arrpos+1] = ct - 1;
        return val;
    }
    if (arr.length === 0) {        return false;
    }
    pointers[arrpos+1] = arr.length - 1;
    return arr[pointers[arrpos+1]];
}

function serialize (mixed_value) {
    // Returns a string representation of variable (which can later be
	// unserialized)
    // 
    // version: 1004.2314
    // discuss at: http://phpjs.org/functions/serialize // + original by: Arpad
	// Ray (mailto:arpad@php.net)
    // + improved by: Dino
    // + bugfixed by: Andrej Pavlovic
    // + bugfixed by: Garagoth
    // + input by: DtTvB
	// (http://dt.in.th/2008-09-16.string-length-in-bytes.html) // + bugfixed
	// by: Russell Walker (http://www.nbill.co.uk/)
    // + bugfixed by: Jamie Beck (http://www.terabit.ca/)
    // + input by: Martin (http://www.erlenwiese.de/)
    // + bugfixed by: Kevin van Zonneveld (http://kevin.vanzonneveld.net)
    // - depends on: utf8_encode // % note: We feel the main purpose of this
	// function should be to ease the transport of data between php & js
    // % note: Aiming for PHP-compatibility, we have to translate objects to
	// arrays
    // * example 1: serialize(['Kevin', 'van', 'Zonneveld']);
    // * returns 1: 'a:3:{i:0;s:5:"Kevin";i:1;s:3:"van";i:2;s:9:"Zonneveld";}'
    // * example 2: serialize({firstName: 'Kevin', midName: 'van', surName:
	// 'Zonneveld'}); // * returns 2:
	// 'a:3:{s:9:"firstName";s:5:"Kevin";s:7:"midName";s:3:"van";s:7:"surName";s:9:"Zonneveld";}'
    var _getType = function (inp) {
        var type = typeof inp, match;
        var key;
        if (type == 'object' && !inp) {            return 'null';
        }
        if (type == "object") {
            if (!inp.constructor) {
                return 'object';            }
            var cons = inp.constructor.toString();
            match = cons.match(/(\w+)\(/);
            if (match) {
                cons = match[1].toLowerCase();            }
            var types = ["boolean", "number", "string", "array"];
            for (key in types) {
                if (cons == types[key]) {
                    type = types[key];                    break;
                }
            }
        }
        return type;    };
    var type = _getType(mixed_value);
    var val, ktype = '';
    
    switch (type) {        case "function": 
            val = ""; 
            break;
        case "boolean":
            val = "b:" + (mixed_value ? "1" : "0");            break;
        case "number":
            val = (Math.round(mixed_value) == mixed_value ? "i" : "d") + ":" + mixed_value;
            break;
        case "string":            mixed_value = this.utf8_encode(mixed_value);
            val = "s:" + encodeURIComponent(mixed_value).replace(/%../g, 'x').length + ":\"" + mixed_value + "\"";
            break;
        case "array":
        case "object":            val = "a";
            /*
			 * if (type == "object") { var objname =
			 * mixed_value.constructor.toString().match(/(\w+)\(\)/); if
			 * (objname == undefined) { return; } objname[1] =
			 * this.serialize(objname[1]); val = "O" + objname[1].substring(1,
			 * objname[1].length - 1); }
			 */
            var count = 0;
            var vals = "";
            var okey;
            var key;            for (key in mixed_value) {
                ktype = _getType(mixed_value[key]);
                if (ktype == "function") { 
                    continue; 
                }                
                okey = (key.match(/^[0-9]+$/) ? parseInt(key, 10) : key);
                vals += this.serialize(okey) +
                        this.serialize(mixed_value[key]);
                count++;            }
            val += ":" + count + ":{" + vals + "}";
            break;
        case "undefined": // Fall-through
        default: // if the JS object has a property which contains a null
					// value, the string cannot be unserialized by PHP val =
					// "N";
            break;
    }
    if (type != "object" && type != "array") {
        val += ";";    }
    return val;
}

function in_array (needle, haystack, argStrict) {
    // Checks if the given value exists in the array
    // 
    // version: 1004.2314
    // discuss at: http://phpjs.org/functions/in_array // + original by: Kevin
	// van Zonneveld (http://kevin.vanzonneveld.net)
    // + improved by: vlado houba
    // + input by: Billy
    // + bugfixed by: Brett Zamir (http://brett-zamir.me)
    // * example 1: in_array('van', ['Kevin', 'van', 'Zonneveld']); // * returns
	// 1: true
    // * example 2: in_array('vlado', {0: 'Kevin', vlado: 'van', 1:
	// 'Zonneveld'});
    // * returns 2: false
    // * example 3: in_array(1, ['1', '2', '3']);
    // * returns 3: true // * example 3: in_array(1, ['1', '2', '3'], false);
    // * returns 3: true
    // * example 4: in_array(1, ['1', '2', '3'], true);
    // * returns 4: false
    var key = '', strict = !!argStrict; 
    if (strict) {
        for (key in haystack) {
            if (haystack[key] === needle) {
                return true;            }
        }
    } else {
        for (key in haystack) {
            if (haystack[key] == needle) {                return true;
            }
        }
    }
     return false;
}

function number_format(number, decimals, dec_point, thousands_sep) {
    // Formats a number with grouped thousands
    // 
    // version: 1004.2314
    // discuss at: http://phpjs.org/functions/number_format // + original by:
	// Jonas Raoni Soares Silva (http://www.jsfromhell.com)
    // + improved by: Kevin van Zonneveld (http://kevin.vanzonneveld.net)
    // + bugfix by: Michael White (http://getsprink.com)
    // + bugfix by: Benjamin Lupton
    // + bugfix by: Allan Jensen (http://www.winternet.no) // + revised by:
	// Jonas Raoni Soares Silva (http://www.jsfromhell.com)
    // + bugfix by: Howard Yeend
    // + revised by: Luke Smith (http://lucassmith.name)
    // + bugfix by: Diogo Resende
    // + bugfix by: Rival // + input by: Kheang Hok Chin
	// (http://www.distantia.ca/)
    // + improved by: davook
    // + improved by: Brett Zamir (http://brett-zamir.me)
    // + input by: Jay Klehr
    // + improved by: Brett Zamir (http://brett-zamir.me) // + input by: Amir
	// Habibi (http://www.residence-mixte.com/)
    // + bugfix by: Brett Zamir (http://brett-zamir.me)
    // + improved by: Theriault
    // * example 1: number_format(1234.56);
    // * returns 1: '1,235' // * example 2: number_format(1234.56, 2, ',', ' ');
    // * returns 2: '1 234,56'
    // * example 3: number_format(1234.5678, 2, '.', '');
    // * returns 3: '1234.57'
    // * example 4: number_format(67, 2, ',', '.'); // * returns 4: '67,00'
    // * example 5: number_format(1000);
    // * returns 5: '1,000'
    // * example 6: number_format(67.311, 2);
    // * returns 6: '67.31' // * example 7: number_format(1000.55, 1);
    // * returns 7: '1,000.6'
    // * example 8: number_format(67000, 5, ',', '.');
    // * returns 8: '67.000,00000'
    // * example 9: number_format(0.9, 0); // * returns 9: '1'
    // * example 10: number_format('1.20', 2);
    // * returns 10: '1.20'
    // * example 11: number_format('1.20', 4);
    // * returns 11: '1.2000' // * example 12: number_format('1.2000', 3);
    // * returns 12: '1.200'
    var n = !isFinite(+number) ? 0 : +number, 
        prec = !isFinite(+decimals) ? 0 : Math.abs(decimals),
        sep = (typeof thousands_sep === 'undefined') ? ',' : thousands_sep,        dec = (typeof dec_point === 'undefined') ? '.' : dec_point,
        s = '',
        toFixedFix = function (n, prec) {
            var k = Math.pow(10, prec);
            return '' + Math.round(n * k) / k;        };
    // Fix for IE parseFloat(0.55).toFixed(0) = 0;
    s = (prec ? toFixedFix(n, prec) : '' + Math.round(n)).split('.');
    if (s[0].length > 3) {
        s[0] = s[0].replace(/\B(?=(?:\d{3})+(?!\d))/g, sep);    }
    if ((s[1] || '').length < prec) {
        s[1] = s[1] || '';
        s[1] += new Array(prec - s[1].length + 1).join('0');
    }    return s.join(dec);
}

function get_html_translation_table (table, quote_style) {
    // Returns the internal translation table used by htmlspecialchars and
	// htmlentities
    // 
    // version: 1004.2314
    // discuss at: http://phpjs.org/functions/get_html_translation_table // +
	// original by: Philip Peterson
    // + revised by: Kevin van Zonneveld (http://kevin.vanzonneveld.net)
    // + bugfixed by: noname
    // + bugfixed by: Alex
    // + bugfixed by: Marco // + bugfixed by: madipta
    // + improved by: KELAN
    // + improved by: Brett Zamir (http://brett-zamir.me)
    // + bugfixed by: Brett Zamir (http://brett-zamir.me)
    // + input by: Frank Forte // + bugfixed by: T.Wild
    // + input by: Ratheous
    // % note: It has been decided that we're not going to add global
    // % note: dependencies to php.js, meaning the constants are not
    // % note: real constants, but strings instead. Integers are also supported
	// if someone // % note: chooses to create the constants themselves.
    // * example 1: get_html_translation_table('HTML_SPECIALCHARS');
    // * returns 1: {'"': '&quot;', '&': '&amp;', '<': '&lt;', '>': '&gt;'}
    
    var entities = {}, hash_map = {}, decimal = 0, symbol = '';    var constMappingTable = {}, constMappingQuoteStyle = {};
    var useTable = {}, useQuoteStyle = {};
    
    // Translate arguments
    constMappingTable[0]      = 'HTML_SPECIALCHARS';    constMappingTable[1]      = 'HTML_ENTITIES';
    constMappingQuoteStyle[0] = 'ENT_NOQUOTES';
    constMappingQuoteStyle[2] = 'ENT_COMPAT';
    constMappingQuoteStyle[3] = 'ENT_QUOTES';
     useTable       = !isNaN(table) ? constMappingTable[table] : table ? table.toUpperCase() : 'HTML_SPECIALCHARS';
    useQuoteStyle = !isNaN(quote_style) ? constMappingQuoteStyle[quote_style] : quote_style ? quote_style.toUpperCase() : 'ENT_COMPAT';
 
    if (useTable !== 'HTML_SPECIALCHARS' && useTable !== 'HTML_ENTITIES') {
        throw new Error("Table: "+useTable+' not supported');        // return
																		// false;
    }
 
    entities['38'] = '&amp;';
    if (useTable === 'HTML_ENTITIES') {        entities['160'] = '&nbsp;';
        entities['161'] = '&iexcl;';
        entities['162'] = '&cent;';
        entities['163'] = '&pound;';
        entities['164'] = '&curren;';        entities['165'] = '&yen;';
        entities['166'] = '&brvbar;';
        entities['167'] = '&sect;';
        entities['168'] = '&uml;';
        entities['169'] = '&copy;';        entities['170'] = '&ordf;';
        entities['171'] = '&laquo;';
        entities['172'] = '&not;';
        entities['173'] = '&shy;';
        entities['174'] = '&reg;';        entities['175'] = '&macr;';
        entities['176'] = '&deg;';
        entities['177'] = '&plusmn;';
        entities['178'] = '&sup2;';
        entities['179'] = '&sup3;';        entities['180'] = '&acute;';
        entities['181'] = '&micro;';
        entities['182'] = '&para;';
        entities['183'] = '&middot;';
        entities['184'] = '&cedil;';        entities['185'] = '&sup1;';
        entities['186'] = '&ordm;';
        entities['187'] = '&raquo;';
        entities['188'] = '&frac14;';
        entities['189'] = '&frac12;';        entities['190'] = '&frac34;';
        entities['191'] = '&iquest;';
        entities['192'] = '&Agrave;';
        entities['193'] = '&Aacute;';
        entities['194'] = '&Acirc;';        entities['195'] = '&Atilde;';
        entities['196'] = '&Auml;';
        entities['197'] = '&Aring;';
        entities['198'] = '&AElig;';
        entities['199'] = '&Ccedil;';        entities['200'] = '&Egrave;';
        entities['201'] = '&Eacute;';
        entities['202'] = '&Ecirc;';
        entities['203'] = '&Euml;';
        entities['204'] = '&Igrave;';        entities['205'] = '&Iacute;';
        entities['206'] = '&Icirc;';
        entities['207'] = '&Iuml;';
        entities['208'] = '&ETH;';
        entities['209'] = '&Ntilde;';        entities['210'] = '&Ograve;';
        entities['211'] = '&Oacute;';
        entities['212'] = '&Ocirc;';
        entities['213'] = '&Otilde;';
        entities['214'] = '&Ouml;';        entities['215'] = '&times;';
        entities['216'] = '&Oslash;';
        entities['217'] = '&Ugrave;';
        entities['218'] = '&Uacute;';
        entities['219'] = '&Ucirc;';        entities['220'] = '&Uuml;';
        entities['221'] = '&Yacute;';
        entities['222'] = '&THORN;';
        entities['223'] = '&szlig;';
        entities['224'] = '&agrave;';        entities['225'] = '&aacute;';
        entities['226'] = '&acirc;';
        entities['227'] = '&atilde;';
        entities['228'] = '&auml;';
        entities['229'] = '&aring;';        entities['230'] = '&aelig;';
        entities['231'] = '&ccedil;';
        entities['232'] = '&egrave;';
        entities['233'] = '&eacute;';
        entities['234'] = '&ecirc;';        entities['235'] = '&euml;';
        entities['236'] = '&igrave;';
        entities['237'] = '&iacute;';
        entities['238'] = '&icirc;';
        entities['239'] = '&iuml;';        entities['240'] = '&eth;';
        entities['241'] = '&ntilde;';
        entities['242'] = '&ograve;';
        entities['243'] = '&oacute;';
        entities['244'] = '&ocirc;';        entities['245'] = '&otilde;';
        entities['246'] = '&ouml;';
        entities['247'] = '&divide;';
        entities['248'] = '&oslash;';
        entities['249'] = '&ugrave;';        entities['250'] = '&uacute;';
        entities['251'] = '&ucirc;';
        entities['252'] = '&uuml;';
        entities['253'] = '&yacute;';
        entities['254'] = '&thorn;';        entities['255'] = '&yuml;';
    }
 
    if (useQuoteStyle !== 'ENT_NOQUOTES') {
        entities['34'] = '&quot;';    }
    if (useQuoteStyle === 'ENT_QUOTES') {
        entities['39'] = '&#39;';
    }
    entities['60'] = '&lt;';    entities['62'] = '&gt;';
 
 
    // ascii decimals to real symbols
    for (decimal in entities) {        symbol = String.fromCharCode(decimal);
        hash_map[symbol] = entities[decimal];
    }
    
    return hash_map;}

function html_entity_decode (string, quote_style) {
    // Convert all HTML entities to their applicable characters
    // 
    // version: 1004.2314
    // discuss at: http://phpjs.org/functions/html_entity_decode // + original
	// by: john (http://www.jd-tech.net)
    // + input by: ger
    // + improved by: Kevin van Zonneveld (http://kevin.vanzonneveld.net)
    // + revised by: Kevin van Zonneveld (http://kevin.vanzonneveld.net)
    // + bugfixed by: Onno Marsman // + improved by: marc andreu
    // + revised by: Kevin van Zonneveld (http://kevin.vanzonneveld.net)
    // + input by: Ratheous
    // + bugfixed by: Brett Zamir (http://brett-zamir.me)
    // + input by: Nick Kolosov (http://sammy.ru) // + bugfixed by: Fox
    // - depends on: get_html_translation_table
    // * example 1: html_entity_decode('Kevin &amp; van Zonneveld');
    // * returns 1: 'Kevin & van Zonneveld'
    // * example 2: html_entity_decode('&amp;lt;'); // * returns 2: '&lt;'
    var hash_map = {}, symbol = '', tmp_str = '', entity = '';
    tmp_str = string.toString();
    
    if (false === (hash_map = this.get_html_translation_table('HTML_ENTITIES', quote_style))) {        return false;
    }
 
    // fix &amp; problem
    // http://phpjs.org/functions/get_html_translation_table:416#comment_97660
	// delete(hash_map['&']);
    hash_map['&'] = '&amp;';
 
    for (symbol in hash_map) {
        entity = hash_map[symbol];        tmp_str = tmp_str.split(entity).join(symbol);
    }
    tmp_str = tmp_str.split('&#039;').join("'");
    
    return tmp_str;}

function microtime (get_as_float) {
    // Returns either a string or a float containing the current time in seconds
	// and microseconds
    // 
    // version: 1004.2314
    // discuss at: http://phpjs.org/functions/microtime // + original by: Paulo
	// Ricardo F. Santos
    // * example 1: timeStamp = microtime(true);
    // * results 1: timeStamp > 1000000000 && timeStamp < 2000000000
    var now = new Date().getTime() / 1000;
    var s = parseInt(now, 10); 
    return (get_as_float) ? now : (Math.round((now - s) * 1000) / 1000) + ' ' + s;
}

function array () {
    // !No description available for array. @php.js developers: Please update
	// the function summary text file.
    // 
    // version: 1004.2314
    // discuss at: http://phpjs.org/functions/array // + original by: d3x
    // * example 1: array('Kevin', 'van', 'Zonneveld');
    // * returns 1: ['Kevin', 'van', 'Zonneveld']
    return Array.prototype.slice.call(arguments);
}

function array_unique (inputArr) {
    // Removes duplicate values from array
    // 
    // version: 1004.2314
    // discuss at: http://phpjs.org/functions/array_unique // + original by:
	// Carlos R. L. Rodrigues (http://www.jsfromhell.com)
    // + input by: duncan
    // + bugfixed by: Kevin van Zonneveld (http://kevin.vanzonneveld.net)
    // + bugfixed by: Nate
    // + input by: Brett Zamir (http://brett-zamir.me) // + bugfixed by: Kevin
	// van Zonneveld (http://kevin.vanzonneveld.net)
    // + improved by: Michael Grier
    // + bugfixed by: Brett Zamir (http://brett-zamir.me)
    // % note 1: The second argument, sort_flags is not implemented;
    // % note 1: also should be sorted (asort?) first according to docs // *
	// example 1: array_unique(['Kevin','Kevin','van','Zonneveld','Kevin']);
    // * returns 1: {0: 'Kevin', 2: 'van', 3: 'Zonneveld'}
    // * example 2: array_unique({'a': 'green', 0: 'red', 'b': 'green', 1:
	// 'blue', 2: 'red'});
    // * returns 2: {a: 'green', 0: 'red', 1: 'blue'}
    var key = '', tmp_arr2 = {}, val = ''; 
    var __array_search = function (needle, haystack) {
        var fkey = '';
        for (fkey in haystack) {
            if (haystack.hasOwnProperty(fkey)) {                if ((haystack[fkey] + '') === (needle + '')) {
                    return fkey;
                }
            }
        }        return false;
    };
 
    for (key in inputArr) {
        if (inputArr.hasOwnProperty(key)) {            val = inputArr[key];
            if (false === __array_search(val, tmp_arr2)) {
                tmp_arr2[key] = val;
            }
        }    }
 
    return tmp_arr2;
}

function date(format, timestamp) {
    // http://kevin.vanzonneveld.net
    // +   original by: Carlos R. L. Rodrigues (http://www.jsfromhell.com)
    // +      parts by: Peter-Paul Koch (http://www.quirksmode.org/js/beat.html)
    // +   improved by: Kevin van Zonneveld (http://kevin.vanzonneveld.net)
    // +   improved by: MeEtc (http://yass.meetcweb.com)
    // +   improved by: Brad Touesnard
    // +   improved by: Tim Wiel
    // +   improved by: Bryan Elliott
    // +   improved by: Brett Zamir (http://brett-zamir.me)
    // +   improved by: David Randall
    // +      input by: Brett Zamir (http://brett-zamir.me)
    // +   bugfixed by: Kevin van Zonneveld (http://kevin.vanzonneveld.net)
    // +   improved by: Brett Zamir (http://brett-zamir.me)
    // +   improved by: Brett Zamir (http://brett-zamir.me)
    // +   improved by: Theriault
    // +  derived from: gettimeofday
    // +      input by: majak
    // +   bugfixed by: majak
    // +   bugfixed by: Kevin van Zonneveld (http://kevin.vanzonneveld.net)
    // +      input by: Alex
    // +   bugfixed by: Brett Zamir (http://brett-zamir.me)
    // +   improved by: Theriault
    // +   improved by: Brett Zamir (http://brett-zamir.me)
    // +   improved by: Theriault
    // +   improved by: Thomas Beaucourt (http://www.webapp.fr)
    // +   improved by: JT
    // +   improved by: Theriault
    // +   improved by: Rafał Kukawski (http://blog.kukawski.pl)
    // %        note 1: Uses global: php_js to store the default timezone
    // *     example 1: date('H:m:s \\m \\i\\s \\m\\o\\n\\t\\h', 1062402400);
    // *     returns 1: '09:09:40 m is month'
    // *     example 2: date('F j, Y, g:i a', 1062462400);
    // *     returns 2: 'September 2, 2003, 2:26 am'
    // *     example 3: date('Y W o', 1062462400);
    // *     returns 3: '2003 36 2003'
    // *     example 4: x = date('Y m d', (new Date()).getTime()/1000); 
    // *     example 4: (x+'').length == 10 // 2009 01 09
    // *     returns 4: true
    // *     example 5: date('W', 1104534000);
    // *     returns 5: '53'
    // *     example 6: date('B t', 1104534000);
    // *     returns 6: '999 31'
    // *     example 7: date('W U', 1293750000.82); // 2010-12-31
    // *     returns 7: '52 1293750000'
    // *     example 8: date('W', 1293836400); // 2011-01-01
    // *     returns 8: '52'
    // *     example 9: date('W Y-m-d', 1293974054); // 2011-01-02
    // *     returns 9: '52 2011-01-02'
    var that = this,
        jsdate, f, formatChr = /\\?([a-z])/gi, formatChrCb,
        // Keep this here (works, but for code commented-out
        // below for file size reasons)
        //, tal= [],
        _pad = function (n, c) {
            if ((n = n + "").length < c) {
                return new Array((++c) - n.length).join("0") + n;
            } else {
                return n;
            }
        },
        txt_words = ["Sun", "Mon", "Tues", "Wednes", "Thurs", "Fri", "Satur",
        "January", "February", "March", "April", "May", "June", "July",
        "August", "September", "October", "November", "December"],
        txt_ordin = {
            1: "st",
            2: "nd",
            3: "rd",
            21: "st", 
            22: "nd",
            23: "rd",
            31: "st"
        };
    formatChrCb = function (t, s) {
        return f[t] ? f[t]() : s;
    };
    f = {
    // Day
        d: function () { // Day of month w/leading 0; 01..31
            return _pad(f.j(), 2);
        },
        D: function () { // Shorthand day name; Mon...Sun
            return f.l().slice(0, 3);
        },
        j: function () { // Day of month; 1..31
            return jsdate.getDate();
        },
        l: function () { // Full day name; Monday...Sunday
            return txt_words[f.w()] + 'day';
        },
        N: function () { // ISO-8601 day of week; 1[Mon]..7[Sun]
            return f.w() || 7;
        },
        S: function () { // Ordinal suffix for day of month; st, nd, rd, th
            return txt_ordin[f.j()] || 'th';
        },
        w: function () { // Day of week; 0[Sun]..6[Sat]
            return jsdate.getDay();
        },
        z: function () { // Day of year; 0..365
            var a = new Date(f.Y(), f.n() - 1, f.j()),
                b = new Date(f.Y(), 0, 1);
            return Math.round((a - b) / 864e5) + 1;
        },

    // Week
        W: function () { // ISO-8601 week number
            var a = new Date(f.Y(), f.n() - 1, f.j() - f.N() + 3),
                b = new Date(a.getFullYear(), 0, 4);
            return 1 + Math.round((a - b) / 864e5 / 7);
        },

    // Month
        F: function () { // Full month name; January...December
            return txt_words[6 + f.n()];
        },
        m: function () { // Month w/leading 0; 01...12
            return _pad(f.n(), 2);
        },
        M: function () { // Shorthand month name; Jan...Dec
            return f.F().slice(0, 3);
        },
        n: function () { // Month; 1...12
            return jsdate.getMonth() + 1;
        },
        t: function () { // Days in month; 28...31
            return (new Date(f.Y(), f.n(), 0)).getDate();
        },

    // Year
        L: function () { // Is leap year?; 0 or 1
            var y = f.Y(), a = y & 3, b = y % 4e2, c = y % 1e2;
            return 0 + (!a && (c || !b));
        },
        o: function () { // ISO-8601 year
            var n = f.n(), W = f.W(), Y = f.Y();
            return Y + (n === 12 && W < 9 ? -1 : n === 1 && W > 9);
        },
        Y: function () { // Full year; e.g. 1980...2010
            return jsdate.getFullYear();
        },
        y: function () { // Last two digits of year; 00...99
            return (f.Y() + "").slice(-2);
        },

    // Time
        a: function () { // am or pm
            return jsdate.getHours() > 11 ? "pm" : "am";
        },
        A: function () { // AM or PM
            return f.a().toUpperCase();
        },
        B: function () { // Swatch Internet time; 000..999
            var H = jsdate.getUTCHours() * 36e2, // Hours
                i = jsdate.getUTCMinutes() * 60, // Minutes
                s = jsdate.getUTCSeconds(); // Seconds
            return _pad(Math.floor((H + i + s + 36e2) / 86.4) % 1e3, 3);
        },
        g: function () { // 12-Hours; 1..12
            return f.G() % 12 || 12;
        },
        G: function () { // 24-Hours; 0..23
            return jsdate.getHours();
        },
        h: function () { // 12-Hours w/leading 0; 01..12
            return _pad(f.g(), 2);
        },
        H: function () { // 24-Hours w/leading 0; 00..23
            return _pad(f.G(), 2);
        },
        i: function () { // Minutes w/leading 0; 00..59
            return _pad(jsdate.getMinutes(), 2);
        },
        s: function () { // Seconds w/leading 0; 00..59
            return _pad(jsdate.getSeconds(), 2);
        },
        u: function () { // Microseconds; 000000-999000
            return _pad(jsdate.getMilliseconds() * 1000, 6);
        },

    // Timezone
        e: function () { // Timezone identifier; e.g. Atlantic/Azores, ...
// The following works, but requires inclusion of the very large
// timezone_abbreviations_list() function.
/*              var abbr = '', i = 0, os = 0;
            if (that.php_js && that.php_js.default_timezone) {
                return that.php_js.default_timezone;
            }
            if (!tal.length) {
                tal = that.timezone_abbreviations_list();
            }
            for (abbr in tal) {
                for (i = 0; i < tal[abbr].length; i++) {
                    os = -jsdate.getTimezoneOffset() * 60;
                    if (tal[abbr][i].offset === os) {
                        return tal[abbr][i].timezone_id;
                    }
                }
            }
*/
            return 'UTC';
        },
        I: function () { // DST observed?; 0 or 1
            // Compares Jan 1 minus Jan 1 UTC to Jul 1 minus Jul 1 UTC.
            // If they are not equal, then DST is observed.
            var a = new Date(f.Y(), 0), // Jan 1
                c = Date.UTC(f.Y(), 0), // Jan 1 UTC
                b = new Date(f.Y(), 6), // Jul 1
                d = Date.UTC(f.Y(), 6); // Jul 1 UTC
            return 0 + ((a - c) !== (b - d));
        },
        O: function () { // Difference to GMT in hour format; e.g. +0200
            var a = jsdate.getTimezoneOffset();
            return (a > 0 ? "-" : "+") + _pad(Math.abs(a / 60 * 100), 4);
        },
        P: function () { // Difference to GMT w/colon; e.g. +02:00
            var O = f.O();
            return (O.substr(0, 3) + ":" + O.substr(3, 2));
        },
        T: function () { // Timezone abbreviation; e.g. EST, MDT, ...
// The following works, but requires inclusion of the very
// large timezone_abbreviations_list() function.
/*              var abbr = '', i = 0, os = 0, default = 0;
            if (!tal.length) {
                tal = that.timezone_abbreviations_list();
            }
            if (that.php_js && that.php_js.default_timezone) {
                default = that.php_js.default_timezone;
                for (abbr in tal) {
                    for (i=0; i < tal[abbr].length; i++) {
                        if (tal[abbr][i].timezone_id === default) {
                            return abbr.toUpperCase();
                        }
                    }
                }
            }
            for (abbr in tal) {
                for (i = 0; i < tal[abbr].length; i++) {
                    os = -jsdate.getTimezoneOffset() * 60;
                    if (tal[abbr][i].offset === os) {
                        return abbr.toUpperCase();
                    }
                }
            }
*/
            return 'UTC';
        },
        Z: function () { // Timezone offset in seconds (-43200...50400)
            return -jsdate.getTimezoneOffset() * 60;
        },

    // Full Date/Time
        c: function () { // ISO-8601 date.
            return 'Y-m-d\\Th:i:sP'.replace(formatChr, formatChrCb);
        },
        r: function () { // RFC 2822
            return 'D, d M Y H:i:s O'.replace(formatChr, formatChrCb);
        },
        U: function () { // Seconds since UNIX epoch
            return jsdate.getTime() / 1000 | 0;
        }
    };
    this.date = function (format, timestamp) {
        that = this;
        jsdate = (
            (typeof timestamp === 'undefined') ? new Date() : // Not provided
            (timestamp instanceof Date) ? new Date(timestamp) : // JS Date()
            new Date(timestamp * 1000) // UNIX timestamp (auto-convert to int)
        );
        return format.replace(formatChr, formatChrCb);
    };
    return this.date(format, timestamp);
}