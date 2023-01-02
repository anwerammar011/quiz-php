var currentQuestion = 1;
var nb_question = 0;
window.addEventListener('load', (event) => {

    nb_question = $(".questionContainer").length;
    $('.questionContainer').hide();
    $("#question1").show();
    $("#btn-precedent").hide();
    $("#form_Envoyer").hide();
});


function nextQuestion(){
    name_choice = "form[QuestionNumero"+ currentQuestion +"]"        
    const radioButtons = document.querySelectorAll('input[name="'+name_choice+'"]');
    var selected = false;
    for (const radioButton of radioButtons) {
        if (radioButton.checked) {
            selected = true;
            break;
        }
    }
    if(selected == false){
        alert("Merci de bien choisir une réponse !");
        return
    }else{
        currentQuestion = currentQuestion + 1;
        $('.questionContainer').hide();
        $("#question"+currentQuestion).show();
        showHideBtn(currentQuestion); 
    }
}

function previousQuestion(){
        currentQuestion = currentQuestion - 1;
      
         $('.questionContainer').hide();
         $("#question"+currentQuestion).show();
         showHideBtn(currentQuestion);
    }

function showHideBtn(currentQuestion){
        switch (currentQuestion) {

            case 1:
                $("#btn-precedent").hide();
                $("#form_Envoyer").hide();
              break;
            case nb_question:
                $("#btn-suivant").hide();
                $("#form_Envoyer").show();
              break;
            default:
                $("#btn-precedent").show();
                $("#btn-suivant").show();
                $("#form_Envoyer").hide();
          }}

          function deleteQuestion(idQuiz){
         window.location.href ="/deleteQuestion/"+idQuiz+"/"+currentQuestion;
          }

          function myFunction(){
            window.location.href ="/deleteQuestion/"+idQuiz+"/"+currentQuestion;
               console.log("bonjour");
             }
    