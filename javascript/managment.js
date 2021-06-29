    const loginBtn = document.getElementById("login");
    const signupBtn = document.getElementById("signup");
    const centerOneForm = document.getElementById("center");
    const centerTwoForm = document.getElementById("center_two");

    signupBtn.onclick = (() => {
        centerTwoForm.style.marginLeft = 0 + "%";
        centerOneForm.style.marginLeft = 100 + "%";
    });

    loginBtn.onclick = (() => {
        centerTwoForm.style.marginLeft = 100 + "%";
        centerOneForm.style.marginLeft = 0 + "%";
    });

    
    // signupBtn.onclick = (() => {
    //     centerTwoForm.style.visibility = "visible";
    //     centerOneForm.style.visibility = "hidden";
    // });

    // loginBtn.onclick = (() => {
    //     centerOneForm.style.visibility = "visible";
    //     centerTwoForm.style.visibility = "hidden";
    // });