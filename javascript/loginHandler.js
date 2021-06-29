
    var elements = Object.values(document.getElementsByClassName("custom__design"));

    elements.forEach(element => {
        element.addEventListener('keyup', function(){
            let length = element.value.length;
            if(length <= 0){
                element.classList.add("down");
                element.classList.remove("up");
            }else {
                element.classList.remove("down");
                element.classList.add("up");
            }

        })
    });