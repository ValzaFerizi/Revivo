
let qyteti1 = "Ferizaj";
let qyteti2 = "Prishtine";
let qyteti3 = "Gjilan";


let qytetiMeIGjate;

if (qyteti1.length >= qyteti2.length && qyteti1.length >= qyteti3.length) {
    qytetiMeIGjate = qyteti1;
} else if (qyteti2.length >= qyteti1.length && qyteti2.length >= qyteti3.length) {
    qytetiMeIGjate = qyteti2;
} else {
    qytetiMeIGjate = qyteti3;
}

console.log("Qyteti me emrin më të gjatë është: " + qytetiMeIGjate);
