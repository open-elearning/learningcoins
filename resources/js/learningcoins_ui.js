
console.log('learningcoins is active');

function installInTiny(){

    if (window.jQuery) { 
        
        var btnLength = $(".cke_button__source").length;

        if(btnLength>0){

            if($(".cke_button__extras_docs").length==0){

                var gi = '<a id="cke_50" onClick="loadCoinObjects();" class="cke_button cke_button__extras_docs cke_button_off" href="javascript:return false;" ';
                gi += ' title="learningcoins" tabindex="-1" hidefocus="true" ';
                gi += ' role="button" aria-labelledby="cke_50_label" ';
                gi += ' aria-describedby="cke_50_description" aria-haspopup="false" >';
                gi += '<span class="cke_button_icon" style="background-image:url(\''+ _p['web_plugin'] +'learningcoins/resources/img/learningcoin.png\');">&nbsp;</span>';
                gi += '<span id="cke_50_description" class="cke_button_label" aria-hidden="false"></span></a>';
                $(".cke_button__source").after(gi);

            }
        }

        var btnProfil = $("#profile_block").length;
        if(btnProfil>0){
            if($("li.profile-social").length>0){
                if($(".profile-learningcoins").length==0){
                    var gi = '<li class="list-group-item profile-learningcoins"> ';
                    gi += '<span class="item-icon">';
                    gi += '<img src="'+ _p['web_plugin'] +'learningcoins/resources/img/learningcoin.png" ';
                    gi += ' alt="LearningCoins" title="LearningCoins"></span> ';
                    gi += '<a href="'+ _p['web_plugin'] +'learningcoins/start.php" >LearningCoins</a>';
                    gi += '</li>';
                    $("li.profile-social").after(gi);
                }
            }
        }

    }

    setTimeout(function(){installInTiny();},500);
    
}

setTimeout(function(){installInTiny();},500);

//#GAMEHUB:1#
function loadCoinObjects(){
    
    var lk = _p['web_plugin'] + 'learningcoins/ajax/ajax.addcoin.php';
    lk = lk.split('/').join('@');
    var h = '<img style="cursor:pointer;" onClick="addLearningCoins(\'test\',5,\'' + lk + '\',this);" ';
    h += ' src="'+ _p['web_plugin'] + 'learningcoins/resources/img/learningcoin-80.gif" />';
    h += '<script src="'+ _p['web_plugin']+'learningcoins/resources/js/learningcoins_ajax.js" type="text/javascript" ></script>';
    
    CKEDITOR.instances.content_lp.insertHtml(h);

}

