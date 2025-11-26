const defaultImage = "./public/R.jpg";

const cards = [
  { id: "card1", image: defaultImage },
  { id: "card2", image: defaultImage },
  { id: "card3", image: defaultImage },
];

function updateCard(imagePath) {
  for (let i = 0; i < cards.length; i++) {
    if (cards[i].image === defaultImage) {
      const cardTroca = document.getElementById(cards[i].id);
      const imageTroca = cardTroca.querySelector("img");
      cards[i].image = imagePath;
      imageTroca.src = imagePath;
      return;
    }
  }
}

function clearCard(id) {
  const card = document.getElementById(id);
  const image = card.querySelector("img");
  image.src = defaultImage;
  for (let i = 0; i < cards.length; i++) {
    if (cards[i].id === id) {
      cards[i].image = defaultImage;
      return;
    }
  }
}
