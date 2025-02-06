console.log(HOME_PAGE);

$('#languages button').on('click', function (){

    const lang_code = $(this).data("langcode");
    console.log("languages = ", lang_code);
    window.location = HOME_PAGE + '/language/change?lang=' + lang_code;

});


