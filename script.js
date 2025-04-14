document.getElementById("sapaButton").addEventListener("click", function () {
    const nama = "Pengunjung";
    const waktu = new Date().getHours();
    let ucapan;

    if (waktu < 12) {
        ucapan = "Selamat pagi";
    } else if (waktu < 18) {
        ucapan = "Selamat siang";
    } else {
        ucapan = "Selamat malam";
    }

    const motivasi = [
        
        `"Knowing yourself is the beginning of all wisdom." – Aristotle`,
        `"Imagination is more important than knowledge." – Albert Einstein`,
        `"The unexamined life is not worth living." – Socrates`,
        `"Everything you can imagine is real." – Pablo Picasso`,
        `"The only way to do great work is to love what you do." – Steve Jobs`,
        `"Happiness depends upon ourselves." – Aristotle`,
        `"We are what we repeatedly do. Excellence, then, is not an act, but a habit." – Will Durant (tentang Aristoteles)`,
        `"Success is not final, failure is not fatal: It is the courage to continue that counts." – Winston Churchill`,
        `"You must be the change you wish to see in the world." – Mahatma Gandhi`,
        `"Art washes away from the soul the dust of everyday life." – Pablo Picasso`
    ];
    

    const randomIndex = Math.floor(Math.random() * motivasi.length);
    const kalimat = motivasi[randomIndex];

    document.getElementById("hasilSapa").innerHTML = `
        ${ucapan}, ${nama}! Senang bertemu denganmu 😊<br><em>${kalimat}</em>
    `;
});
