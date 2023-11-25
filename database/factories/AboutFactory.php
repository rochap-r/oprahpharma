<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\About>
 */
class AboutFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'about'=>"
                    <h2>À propos de nous</h2>
                    <p>Nous sommes l'université technologique Kanyik Tesh, une université en cours de construction à Kolwezi en RDC qui va révolutionner avec sa politique d'enseignement. Nous proposons des formations techniques dans les domaines des mines, de la géologie, de la chimie, de la mécanique, de l'électricité, de l'électronique et de l'informatique.</p>
                    <p>Nous adoptons le système LMD basé sur plus de réalité pratique que théorique. Nous offrons un enseignement de qualité et reconnu, assuré par des enseignants qualifiés et expérimentés. Nous requérons le baccalauréat ou un diplôme équivalent pour accéder à nos formations, dont la durée varie selon le domaine et le niveau de diplôme.</p>
                    ",
            'about_img'=>"",
            'project'=>"
                    <h2>Nos projets futurs</h2>
                    <ul>
                        <li>Finaliser la construction du campus et l'équiper avec des infrastructures modernes et performantes.</li>
                        <li>Développer des partenariats avec des acteurs locaux et internationaux du monde académique, professionnel et social.</li>
                        <li>Lancer des programmes de recherche innovants et interdisciplinaires dans nos domaines de formation.</li>
                        <li>Renforcer l'accompagnement et l'insertion professionnelle de nos étudiants et diplômés.</li>
                        <li>Promouvoir la diversité et l'ouverture culturelle au sein de notre communauté universitaire.</li>
                    </ul>
            ",
            'project_img'=>"",
            'galery'=>"
                    <h2>Notre Galerie</h2>
                    <p>Nous sommes ravis de partager avec vous notre vision et notre passion pour l’éducation et la science.
                        Dans cette section, vous trouverez quelques images récentes sélectionnées de la galerie qui illustrent nos activités,
                        nos projets et notre campus en construction.
                        Vous pourrez voir à quoi ressemblera le résultat final de notre ambitieux programme de développement et d’innovation. Bonne visite!
                    </p>
            "
        ];
    }
}
