

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
        let emptyMessage = document.createElement("p");
        $(emptyMessage).attr("id","no_results_msg")
            .css("text-size","20px");
        emptyMessage.innerHTML = "Search returned 0 results!";
        document.getElementById("rec").appendChild(emptyMessage);
        return;
    }
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


$(document).ready(function () {
    var lastSearch = "";
    var ok = false;
    $.ajax({
        url: "php/get_all.php",
        type:  'GET',
        action: 'getAll',
        success: (response) =>{
            parseRecipes(response);
        }
    });
    
    $("button").click(function () {
        let typeContent = $("#search").val();
        $("#rec").empty();
        if(ok) {
            console.log(lastSearch);
            console.log(ok);
            lastSearchObj = document.createElement("div");
            lastSearchObj.innerHTML = "<p>Last search key is: \' "+lastSearch+"\'</p>";
            document.getElementById("rec").appendChild(lastSearchObj);
        }
        else{
            ok=true;
        }
        if(typeContent.length === 0){
            $.ajax({
                url: "php/get_all.php",
                type: 'GET',
                success: (response) => {
                    parseRecipes(response);
                }
            });
        }
        else{
            $.ajax(
                {
                    url: "php/same_type.php",
                    type: 'GET',
                    data:{
                        type_rec: typeContent
                    },
                    success: (response) => {
                        lastSearch = typeContent;
                        parseRecipes(response);
                    }
                }
            );
        }
    });
});