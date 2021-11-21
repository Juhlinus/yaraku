<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $json = <<<JSON
[
  {
    "author": "Chinua Achebe",
    "title": "Things Fall Apart"
  },
  {
    "author": "Hans Christian Andersen",
    "title": "Fairy tales"
  },
  {
    "author": "Dante Alighieri",
    "title": "The Divine Comedy"
  },
  {
    "author": "Unknown",
    "title": "The Epic Of Gilgamesh"
  },
  {
    "author": "Unknown",
    "title": "The Book Of Job"
  },
  {
    "author": "Unknown",
    "title": "One Thousand and One Nights"
  },
  {
    "author": "Unknown",
    "title": "Nj\u00e1l's Saga"
  },
  {
    "author": "Jane Austen",
    "title": "Pride and Prejudice"
  },
  {
    "author": "Honor\u00e9 de Balzac",
    "title": "Le P\u00e8re Goriot"
  },
  {
    "author": "Samuel Beckett",
    "title": "Molloy, Malone Dies, The Unnamable, the trilogy"
  },
  {
    "author": "Giovanni Boccaccio",
    "title": "The Decameron"
  },
  {
    "author": "Jorge Luis Borges",
    "title": "Ficciones"
  },
  {
    "author": "Emily Bront\u00eb",
    "title": "Wuthering Heights"
  },
  {
    "author": "Albert Camus",
    "title": "The Stranger"
  },
  {
    "author": "Paul Celan",
    "title": "Poems"
  },
  {
    "author": "Louis-Ferdinand C\u00e9line",
    "title": "Journey to the End of the Night"
  },
  {
    "author": "Miguel de Cervantes",
    "title": "Don Quijote De La Mancha"
  },
  {
    "author": "Geoffrey Chaucer",
    "title": "The Canterbury Tales"
  },
  {
    "author": "Anton Chekhov",
    "title": "Stories"
  },
  {
    "author": "Joseph Conrad",
    "title": "Nostromo"
  },
  {
    "author": "Charles Dickens",
    "title": "Great Expectations"
  },
  {
    "author": "Denis Diderot",
    "title": "Jacques the Fatalist"
  },
  {
    "author": "Alfred D\u00f6blin",
    "title": "Berlin Alexanderplatz"
  },
  {
    "author": "Fyodor Dostoevsky",
    "title": "Crime and Punishment"
  },
  {
    "author": "Fyodor Dostoevsky",
    "title": "The Idiot"
  },
  {
    "author": "Fyodor Dostoevsky",
    "title": "The Possessed"
  },
  {
    "author": "Fyodor Dostoevsky",
    "title": "The Brothers Karamazov"
  },
  {
    "author": "George Eliot",
    "title": "Middlemarch"
  },
  {
    "author": "Ralph Ellison",
    "title": "Invisible Man"
  },
  {
    "author": "Euripides",
    "title": "Medea"
  },
  {
    "author": "William Faulkner",
    "title": "Absalom, Absalom!"
  },
  {
    "author": "William Faulkner",
    "title": "The Sound and the Fury"
  },
  {
    "author": "Gustave Flaubert",
    "title": "Madame Bovary"
  },
  {
    "author": "Gustave Flaubert",
    "title": "Sentimental Education"
  },
  {
    "author": "Federico Garc\u00eda Lorca",
    "title": "Gypsy Ballads"
  },
  {
    "author": "Gabriel Garc\u00eda M\u00e1rquez",
    "title": "One Hundred Years of Solitude"
  },
  {
    "author": "Gabriel Garc\u00eda M\u00e1rquez",
    "title": "Love in the Time of Cholera"
  },
  {
    "author": "Johann Wolfgang von Goethe",
    "title": "Faust"
  },
  {
    "author": "Nikolai Gogol",
    "title": "Dead Souls"
  },
  {
    "author": "G\u00fcnter Grass",
    "title": "The Tin Drum"
  },
  {
    "author": "Jo\u00e3o Guimar\u00e3es Rosa",
    "title": "The Devil to Pay in the Backlands"
  },
  {
    "author": "Knut Hamsun",
    "title": "Hunger"
  },
  {
    "author": "Ernest Hemingway",
    "title": "The Old Man and the Sea"
  },
  {
    "author": "Homer",
    "title": "Iliad"
  },
  {
    "author": "Homer",
    "title": "Odyssey"
  },
  {
    "author": "Henrik Ibsen",
    "title": "A Doll's House"
  },
  {
    "author": "James Joyce",
    "title": "Ulysses"
  },
  {
    "author": "Franz Kafka",
    "title": "Stories"
  },
  {
    "author": "Franz Kafka",
    "title": "The Trial"
  },
  {
    "author": "Franz Kafka",
    "title": "The Castle"
  },
  {
    "author": "K\u0101lid\u0101sa",
    "title": "The recognition of Shakuntala"
  },
  {
    "author": "Yasunari Kawabata",
    "title": "The Sound of the Mountain"
  },
  {
    "author": "Nikos Kazantzakis",
    "title": "Zorba the Greek"
  },
  {
    "author": "D. H. Lawrence",
    "title": "Sons and Lovers"
  },
  {
    "author": "Halld\u00f3r Laxness",
    "title": "Independent People"
  },
  {
    "author": "Giacomo Leopardi",
    "title": "Poems"
  },
  {
    "author": "Doris Lessing",
    "title": "The Golden Notebook"
  },
  {
    "author": "Astrid Lindgren",
    "title": "Pippi Longstocking"
  },
  {
    "author": "Lu Xun",
    "title": "Diary of a Madman"
  },
  {
    "author": "Naguib Mahfouz",
    "title": "Children of Gebelawi"
  },
  {
    "author": "Thomas Mann",
    "title": "Buddenbrooks"
  },
  {
    "author": "Thomas Mann",
    "title": "The Magic Mountain"
  },
  {
    "author": "Herman Melville",
    "title": "Moby Dick"
  },
  {
    "author": "Michel de Montaigne",
    "title": "Essays"
  },
  {
    "author": "Elsa Morante",
    "title": "History"
  },
  {
    "author": "Toni Morrison",
    "title": "Beloved"
  },
  {
    "author": "Murasaki Shikibu",
    "title": "The Tale of Genji"
  },
  {
    "author": "Robert Musil",
    "title": "The Man Without Qualities"
  },
  {
    "author": "Vladimir Nabokov",
    "title": "Lolita"
  },
  {
    "author": "George Orwell",
    "title": "Nineteen Eighty-Four"
  },
  {
    "author": "Ovid",
    "title": "Metamorphoses"
  },
  {
    "author": "Fernando Pessoa",
    "title": "The Book of Disquiet"
  },
  {
    "author": "Edgar Allan Poe",
    "title": "Tales"
  },
  {
    "author": "Marcel Proust",
    "title": "In Search of Lost Time"
  },
  {
    "author": "Fran\u00e7ois Rabelais",
    "title": "Gargantua and Pantagruel"
  },
  {
    "author": "Juan Rulfo",
    "title": "Pedro P\u00e1ramo"
  },
  {
    "author": "Rumi",
    "title": "The Masnavi"
  },
  {
    "author": "Salman Rushdie",
    "title": "Midnight's Children"
  },
  {
    "author": "Saadi",
    "title": "Bostan"
  },
  {
    "author": "Tayeb Salih",
    "title": "Season of Migration to the North"
  },
  {
    "author": "Jos\u00e9 Saramago",
    "title": "Blindness"
  },
  {
    "author": "William Shakespeare",
    "title": "Hamlet"
  },
  {
    "author": "William Shakespeare",
    "title": "King Lear"
  },
  {
    "author": "William Shakespeare",
    "title": "Othello"
  },
  {
    "author": "Sophocles",
    "title": "Oedipus the King"
  },
  {
    "author": "Stendhal",
    "title": "The Red and the Black"
  },
  {
    "author": "Laurence Sterne",
    "title": "The Life And Opinions of Tristram Shandy"
  },
  {
    "author": "Italo Svevo",
    "title": "Confessions of Zeno"
  },
  {
    "author": "Jonathan Swift",
    "title": "Gulliver's Travels"
  },
  {
    "author": "Leo Tolstoy",
    "title": "War and Peace"
  },
  {
    "author": "Leo Tolstoy",
    "title": "Anna Karenina"
  },
  {
    "author": "Leo Tolstoy",
    "title": "The Death of Ivan Ilyich"
  },
  {
    "author": "Mark Twain",
    "title": "The Adventures of Huckleberry Finn"
  },
  {
    "author": "Valmiki",
    "title": "Ramayana"
  },
  {
    "author": "Virgil",
    "title": "The Aeneid"
  },
  {
    "author": "Vyasa",
    "title": "Mahabharata"
  },
  {
    "author": "Walt Whitman",
    "title": "Leaves of Grass"
  },
  {
    "author": "Virginia Woolf",
    "title": "Mrs Dalloway"
  },
  {
    "author": "Virginia Woolf",
    "title": "To the Lighthouse"
  },
  {
    "author": "Marguerite Yourcenar",
    "title": "Memoirs of Hadrian"
  }
]
JSON;

        \App\Models\Book::insert(json_decode($json, true));
    }
}
