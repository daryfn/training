window.onload = function() {

    let menit = 00;
    let detik = 00;
    let miliDetik = 00;
    
    let appendMenit =
        document.getElementById("menit");
    
    let appendDetik =
        document.getElementById("detik");

    let appendMiliDetik =
        document.getElementById("miliDetik");

    let buttonStop =
        document.getElementById("stop");
    
    let buttonStart =
        document.getElementById("start");
    
    let buttonLap = 
        document.getElementById("lap");

    let buttonReset =
        document.getElementById("reset");

    let interval;

    buttonStop.onclick = function() {
        clearInterval(interval);
    }

    buttonStart.onclick = function() {
        clearInterval(interval);
        interval = setInterval(startTimer, 10);
    }

    buttonLap.onclick = function() {
        record = `<div id="lap-record">${menit} : ${detik}.${miliDetik}</div>`;
        document.getElementById("lapTime").innerHTML += `${record}`;
        // buttonLap.innerHTML += record;

        // for (; record <=20;) {
        //     document.getElementById("lapTime").innerHTML = `<p> ${record} </p>`
        //     record++;
        // }
        
        // function recordLaps(){
        //     // let x = document.getElementsById("lap").value;
        //     // if (i = x, i++)
        //     document.getElementById("lapTime").innerHTML = `<p> ${record} </p>`;
        // }   
    }

    buttonReset.onclick = function() {
        clearInterval(interval);
        menit = "00";
        detik = "00";
        miliDetik = "00";
        appendMenit.innerHTML = menit;
        appendDetik.innerHTML = detik;
        appendMiliDetik.innerHTML = miliDetik;
        document.getElementById("lapTime").innerHTML = ``;

    }

    function startTimer(){
        miliDetik++;

        if (miliDetik <= 9){
            appendMiliDetik.innerHTML = "0" + miliDetik;    
        }

        if (miliDetik > 9){
            appendMiliDetik.innerHTML = miliDetik;
        }

        if (miliDetik > 99) {
            console.log("detik");
            detik++;
            appendDetik.innerHTML = "0" + detik;
            miliDetik = 0;
            appendMiliDetik.innerHTML = 0 + 0;
        }

        if (detik > 9) {
            appendDetik.innerHTML = detik;
        }

        if (detik > 59) {
            console.log("menit"); 
            menit++;
            appendMenit.innerHTML = "0" + menit;
            detik = 0;
            appendDetik.innerHTML = "0" + 0;
        }
    }
}
