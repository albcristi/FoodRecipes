

function writeRecipe(recipeJSON){
    console.log(recipeJSON);
    let recipe = document.createElement("div");
    let nameParagraph = document.createElement("p");
    let chefName = document.createElement("p");
    let description = document.createElement("p");
    let steps = document.createElement("p");
    let type = document.createElement("p");
    let id = document.createElement("p")
    nameParagraph.innerHTML = recipeJSON['name'];
    chefName.innerHTML = "By "+recipeJSON['chefFname']+" "+recipeJSON['chefLname'];
    description.innerHTML = "Description</br>"+recipeJSON['description'];
    steps.innerHTML = "Steps</br>"+recipeJSON['steps'];
    type.innerHTML = "Type: </br>"+recipeJSON['type'];
    id.innerHTML = "ID: "+recipeJSON['id'];
    $(recipe).attr("class","recipeClass");
    $(recipe).append(nameParagraph);
    $(recipe).append(chefName);
    $(recipe).append(description);
    $(recipe).append(steps);
    $(recipe).append(type);
    $(recipe).append(id);
    document.getElementById("rec").appendChild(recipe);
}

function parseRecipes(data) {
    if(data.length < 5){
        return;
    }
    $("#rec").empty();
    let firstIndex = data.indexOf('{');
    let secondIndex = data.indexOf('}');
    while (data.length >10){
        writeRecipe(
            JSON.parse(
                data.substring(
                    data.indexOf('{'),
                    data.indexOf('}')+1
                ))
        );
        data = data.substring(data.indexOf('}')+1);
    }

}

function showRecipes(URL){
   $.get(
       URL,
       data => {
           parseRecipes(data);
       }
   )
}

$(document).ready(function () {
    $.ajax({
        url: "php/get_all.php",
        type:  'GET',
        action: 'getAll',
        success: (response) =>{
            showRecipes('php/get_all.php');
        }
    });
    
    $("button").click(function () {
        let typeContent = $("#search").val();
        if(typeContent.length === 0){
            $.ajax({
                url: "php/get_all.php",
                type: 'GET',
                success: (response) => {
                    showRecipes('php/get_all.php');
                }
            });
        }
        else{
            //todo: WHEN WE HAVE A SELECTION CRITERIA 
            ///todo: make same_type.php work ...
            $.ajax(
                {
                    url: "php/same_type.php",
                    type: 'GET',
                    data:{
                        type_rec: typeContent
                    },
                    success: (response) => {
                        showRecipes('php/same_type.php');
                    }
                }
            );
        }
    });
});