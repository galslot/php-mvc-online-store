
$('#languages button').on('click', function (){

    const lang_code = $(this).data("langcode");
    console.log("languages = ", lang_code);
    window.location = base_url + 'language/change?lang=' + lang_code;

});


