 const inputs = document.querySelectorAll(".otp-input");
    const hiddenInput = document.getElementById("kode");

    inputs.forEach((input, index) => {

        input.addEventListener("input", (e) => {
            // hanya angka
            input.value = input.value.replace(/[^0-9]/g, "");

            if (input.value && index < inputs.length - 1) {
                inputs[index + 1].focus();
            }

            gabungKode();
        });

        input.addEventListener("keydown", (e) => {
            if (e.key === "Backspace" && !input.value && index > 0) {
                inputs[index - 1].focus();
            }
        });

    });

    function gabungKode(){
        let kode = "";
        inputs.forEach(input => {
            kode += input.value;
        });
        hiddenInput.value = kode;
    }