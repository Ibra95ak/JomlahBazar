// Class definition
var KTTagify = function() {

    // Private functions
    var demo1 = function() {
        var input = document.getElementById('kt_tagify_1'),
            // init Tagify script on the above inputs
            tagify = new Tagify(input, {
                whitelist: ["A# .NET", "A# (Axiom)", "A-0 System", "A+", "A++", "ABAP", "ABC", "ABC ALGOL", "ABSET", "ABSYS", "ACC", "Accent", "Ace DASL", "ACL2", "Avicsoft", "ACT-III", "Action!", "ActionScript", "Ada", "Adenine", "Agda", "Agilent VEE", "Agora", "AIMMS", "Alef", "ALF", "ALGOL 58", "ALGOL 60", "ALGOL 68", "ALGOL W", "Alice", "Alma-0", "AmbientTalk", "Amiga E", "AMOS", "AMPL", "Apex (Salesforce.com)", "APL", "AppleScript", "Arc", "ARexx", "Argus", "AspectJ", "Assembly language", "ATS", "Ateji PX", "AutoHotkey", "Autocoder", "AutoIt", "AutoLISP / Visual LISP", "Averest", "AWK", "Axum", "Active Server Pages", "ASP.NET", "B", "Babbage", "Bash", "BASIC", "bc", "BCPL", "BeanShell", "Batch (Windows/Dos)", "Bertrand", "BETA", "Bigwig", "Bistro", "BitC", "BLISS", "Blockly", "BlooP", "Blue", "Boo", "Boomerang", "Bourne shell (including bash and ksh)", "BREW", "BPEL", "B", "C--", "C++ – ISO/IEC 14882", "C# – ISO/IEC 23270", "C/AL", "Caché ObjectScript", "C Shell", "Caml", "Cayenne", "CDuce", "Cecil", "Cesil", "Céu", "Ceylon", "CFEngine", "CFML", "Cg", "Ch", "Chapel", "Charity", "Charm", "Chef", "CHILL", "CHIP-8", "chomski", "ChucK", "CICS", "Cilk", "Citrine (programming language)", "CL (IBM)", "Claire", "Clarion", "Clean", "Clipper", "CLIPS", "CLIST", "Clojure", "CLU", "CMS-2", "COBOL – ISO/IEC 1989", "CobolScript – COBOL Scripting language", "Cobra", "CODE", "CoffeeScript", "ColdFusion", "COMAL", "Combined Programming Language (CPL)", "COMIT", "Common Intermediate Language (CIL)", "Common Lisp (also known as CL)", "COMPASS", "Component Pascal", "Constraint Handling Rules (CHR)", "COMTRAN", "Converge", "Cool", "Coq", "Coral 66", "Corn", "CorVision", "COWSEL", "CPL", "CPL", "Cryptol", "csh", "Csound", "CSP", "CUDA", "Curl", "Curry", "Cybil", "Cyclone", "Cython", "Java", "Javascript", "M2001", "M4", "M#", "Machine code", "MAD (Michigan Algorithm Decoder)", "MAD/I", "Magik", "Magma", "make", "Maple", "MAPPER now part of BIS", "MARK-IV now VISION:BUILDER", "Mary", "MASM Microsoft Assembly x86", "MATH-MATIC", "Mathematica", "MATLAB", "Maxima (see also Macsyma)", "Max (Max Msp – Graphical Programming Environment)", "Maya (MEL)", "MDL", "Mercury", "Mesa", "Metafont", "Microcode", "MicroScript", "MIIS", "Milk (programming language)", "MIMIC", "Mirah", "Miranda", "MIVA Script", "ML", "Model 204", "Modelica", "Modula", "Modula-2", "Modula-3", "Mohol", "MOO", "Mortran", "Mouse", "MPD", "Mathcad", "MSIL – deprecated name for CIL", "MSL", "MUMPS", "Mystic Programming L"],
                blacklist: [".NET", "PHP"], // <-- passed as an attribute in this demo
            })


        // "remove all tags" button event listener
        document.getElementById('kt_tagify_1_remove').addEventListener('click', tagify.removeAllTags.bind(tagify))

        // Chainable event listeners
        tagify.on('add', onAddTag)
            .on('remove', onRemoveTag)
            .on('input', onInput)
            .on('edit', onTagEdit)
            .on('invalid', onInvalidTag)
            .on('click', onTagClick)
            .on('dropdown:show', onDropdownShow)
            .on('dropdown:hide', onDropdownHide)

        // tag added callback
        function onAddTag(e) {
            console.log("onAddTag: ", e.detail);
            console.log("original input value: ", input.value)
            tagify.off('add', onAddTag) // exmaple of removing a custom Tagify event
        }

        // tag remvoed callback
        function onRemoveTag(e) {
            console.log(e.detail);
            console.log("tagify instance value:", tagify.value)
        }

        // on character(s) added/removed (user is typing/deleting)
        function onInput(e) {
            console.log(e.detail);
            console.log("onInput: ", e.detail);
        }

        function onTagEdit(e) {
            console.log("onTagEdit: ", e.detail);
        }

        // invalid tag added callback
        function onInvalidTag(e) {
            console.log("onInvalidTag: ", e.detail);
        }

        // invalid tag added callback
        function onTagClick(e) {
            console.log(e.detail);
            console.log("onTagClick: ", e.detail);
        }

        function onDropdownShow(e) {
            console.log("onDropdownShow: ", e.detail)
        }

        function onDropdownHide(e) {
            console.log("onDropdownHide: ", e.detail)
        }
    }

    var demo2 = function() {
        var input = document.getElementById('kt_tagify_2');
        var tagify = new Tagify(input, {
            enforceWhitelist: true,
            whitelist: [{value:"Cosmetics", id:1}, {value:"Food", id:2}, {value:"Electronics", id:3}],
            callbacks: {
                //add: console.log, // callback when adding a tag
              //  remove: console.log // callback when removing a tag
            }
        });

        tagify.addTags([{value:"Cosmetics", id:1}, {value:"Food", id:2}, {value:"Electronics", id:3}]);
    }

    var selectedvals = function() {
        var input = document.getElementById('kt_tagify_2');
        var tagify = new Tagify(input, {
            enforceWhitelist: true,
            whitelist: [{value:"Cosmetics", id:1}, {value:"Food", id:2}, {value:"Electronics", id:3}],
            callbacks: {
                //add: console.log, // callback when adding a tag
              //  remove: console.log // callback when removing a tag
            }
        });
        tagify.value.forEach((item, i) => {
          console.log(item['id']);
        });
    }
    var demo3 = function() {
        var input = document.getElementById('kt_tagify_3');

        // init Tagify script on the above inputs
        var tagify = new Tagify(input);

        // add a class to Tagify's input element
        //tagify.DOM.input.classList.remove('tagify__input');
        tagify.DOM.input.classList.add('form-control');
        tagify.DOM.input.setAttribute('placeholder', 'enter tag...');

        // re-place Tagify's input element outside of the  element (tagify.DOM.scope), just before it
        tagify.DOM.scope.parentNode.insertBefore(tagify.DOM.input, tagify.DOM.scope);
    }

    var demo4 = function() {
        var input = document.getElementById('kt_tagify_4');
        var tagify = new Tagify(input, {
            pattern: /^.{0,20}$/, // Validate typed tag(s) by Regex. Here maximum chars length is defined as "20"
            delimiters: ", ", // add new tags when a comma or a space character is entered
            maxTags: 6,
            blacklist: ["fuck", "shit", "pussy"],
            keepInvalidTags: true, // do not remove invalid tags (but keep them marked as invalid)
            whitelist: ["temple", "stun", "detective", "sign", "passion", "routine", "deck", "discriminate", "relaxation", "fraud", "attractive", "soft", "forecast", "point", "thank", "stage", "eliminate", "effective", "flood", "passive", "skilled", "separation", "contact", "compromise", "reality", "district", "nationalist", "leg", "porter", "conviction", "worker", "vegetable", "commerce", "conception", "particle", "honor", "stick", "tail", "pumpkin", "core", "mouse", "egg", "population", "unique", "behavior", "onion", "disaster", "cute", "pipe", "sock", "dialect", "horse", "swear", "owner", "cope", "global", "improvement", "artist", "shed", "constant", "bond", "brink", "shower", "spot", "inject", "bowel", "homosexual", "trust", "exclude", "tough", "sickness", "prevalence", "sister", "resolution", "cattle", "cultural", "innocent", "burial", "bundle", "thaw", "respectable", "thirsty", "exposure", "team", "creed", "facade", "calendar", "filter", "utter", "dominate", "predator", "discover", "theorist", "hospitality", "damage", "woman", "rub", "crop", "unpleasant", "halt", "inch", "birthday", "lack", "throne", "maximum", "pause", "digress", "fossil", "policy", "instrument", "trunk", "frame", "measure", "hall", "support", "convenience", "house", "partnership", "inspector", "looting", "ranch", "asset", "rally", "explicit", "leak", "monarch", "ethics", "applied", "aviation", "dentist", "great", "ethnic", "sodium", "truth", "constellation", "lease", "guide", "break", "conclusion", "button", "recording", "horizon", "council", "paradox", "bride", "weigh", "like", "noble", "transition", "accumulation", "arrow", "stitch", "academy", "glimpse", "case", "researcher", "constitutional", "notion", "bathroom", "revolutionary", "soldier", "vehicle", "betray", "gear", "pan", "quarter", "embarrassment", "golf", "shark", "constitution", "club", "college", "duty", "eaux", "know", "collection", "burst", "fun", "animal", "expectation", "persist", "insure", "tick", "account", "initiative", "tourist", "member", "example", "plant", "river", "ratio", "view", "coast", "latest", "invite", "help", "falsify", "allocation", "degree", "feel", "resort", "means", "excuse", "injury", "pupil", "shaft", "allow", "ton", "tube", "dress", "speaker", "double", "theater", "opposed", "holiday", "screw", "cutting", "picture", "laborer", "conservation", "kneel", "miracle", "brand", "nomination", "characteristic", "referral", "carbon", "valley", "hot", "climb", "wrestle", "motorist", "update", "loot", "mosquito", "delivery", "eagle", "guideline", "hurt", "feedback", "finish", "traffic", "competence", "serve", "archive", "feeling", "hope", "seal", "ear", "oven", "vote", "ballot", "study", "negative", "declaration", "particular", "pattern", "suburb", "intervention", "brake", "frequency", "drink", "affair", "contemporary", "prince", "dry", "mole", "lazy", "undermine", "radio", "legislation", "circumstance", "bear", "left", "pony", "industry", "mastermind", "criticism", "sheep", "failure", "chain", "depressed", "launch", "script", "green", "weave", "please", "surprise", "doctor", "revive", "banquet", "belong", "correction", "door", "image", "integrity", "intermediate", "sense", "formal", "cane", "gloom", "toast", "pension", "exception", "prey", "random", "nose", "predict", "needle", "satisfaction", "establish", "fit", "vigorous", "urgency", "X-ray", "equinox", "variety", "proclaim", "conceive", "bulb", "vegetarian", "available", "stake", "publicity", "strikebreaker", "portrait", "sink", "frog", "ruin", "studio", "match", "electron", "captain", "channel", "navy", "set", "recommend", "appoint", "liberal", "missile", "sample", "result", "poor", "efflux", "glance", "timetable", "advertise", "personality", "aunt", "dog"],
            transformTag: transformTag,
            dropdown: {
                enabled: 3,
            }
        });

        function transformTag(tagData) {
            var states = [
                'success',
                'brand',
                'danger',
                'success',
                'warning',
                'dark',
                'primary',
                'info'];

            tagData.class = 'tagify__tag tagify__tag--' + states[KTUtil.getRandomInt(0, 7)];

            if (tagData.value.toLowerCase() == 'shit') {
                tagData.value = 's✲✲t'
            }
        }

        tagify.on('add', function(e) {
            console.log(e.detail)
        });

        tagify.on('invalid', function(e) {
            console.log(e, e.detail);
        });
    }

    var demo5 = function() {
        // Init autocompletes
        var toEl = document.getElementById('kt_tagify_5');
        var tagifyTo = new Tagify(toEl, {
            delimiters: ", ", // add new tags when a comma or a space character is entered
            maxTags: 10,
            blacklist: ["fuck", "shit", "pussy"],
            keepInvalidTags: true, // do not remove invalid tags (but keep them marked as invalid)
            whitelist: [
                {
                value : 'Chris Muller',
                email : 'chris.muller@wix.com',
                initials: '',
                initialsState: '',
                pic: './'+DIR_MED+DIR_USR+'100_11.jpg',
                class : 'tagify__tag--brand'
            }, {
                value : 'Nick Bold',
                email : 'nick.seo@gmail.com',
                initials: 'SS',
                initialsState: 'warning',
                pic: ''
            }, {
                value : 'Alon Silko',
                email : 'alon@keenthemes.com',
                initials: '',
                initialsState: '',
                pic: './'+DIR_MED+DIR_USR+'100_6.jpg'
            }, {
                value : 'Sam Seanic',
                email : 'sam.senic@loop.com',
                initials: '',
                initialsState: '',
                pic: './'+DIR_MED+DIR_USR+'100_8.jpg'
            }, {
                value : 'Sara Loran',
                email : 'sara.loran@tilda.com',
                initials: '',
                initialsState: '',
                pic: './'+DIR_MED+DIR_USR+'100_9.jpg'
            }, {
                value : 'Eric Davok',
                email : 'davok@mix.com',
                initials: '',
                initialsState: '',
                pic: './'+DIR_MED+DIR_USR+'100_13.jpg'
            }, {
                value : 'Sam Seanic',
                email : 'sam.senic@loop.com',
                initials: '',
                initialsState: '',
                pic: './'+DIR_MED+DIR_USR+'100_13.jpg'
            }, {
                value : 'Lina Nilson',
                email : 'lina.nilson@loop.com',
                initials: 'LN',
                initialsState: 'danger',
                pic: './'+DIR_MED+DIR_USR+'100_15.jpg'
            }],
            templates: {
                dropdownItem : function(tagData){
                    try{
                        return '<div class="tagify__dropdown__item">' +
                            '<div class="kt-media-card">' +
                            '    <span class="kt-media kt-media--'+(tagData.initialsState?tagData.initialsState:'')+'" style="background-image: url('+tagData.pic+')">' +
                            '        <span>'+tagData.initials+'</span>' +
                            '    </span>' +
                            '    <div class="kt-media-card__info">' +
                            '        <a href="#" class="kt-media-card__title">'+tagData.value+'</a>' +
                            '        <span class="kt-media-card__desc">'+tagData.email+'</span>' +
                            '    </div>' +
                            '</div>' +
                            '</div>';
                    }
                    catch(err){}
                }
            },
            transformTag: function(tagData) {
                tagData.class = 'tagify__tag tagify__tag--brand';
            },
            dropdown : {
                classname : "color-blue",
                enabled   : 1,
                maxItems  : 5
            }
        });
    }

    return {
        // public functions
        init: function() {
          //  demo1();
            demo2();
            //demo3();
          //  demo4();
          //  demo5();
        }
    };
}();

jQuery(document).ready(function() {
    KTTagify.init();
});
