<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Rank>
 */
class RankFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'logo'=>'apple-touch-icon.png',
            'name'=>'Fondation Ruwej A NKOND',
            'description'=>"La République démocratique du Congo en général et la Province du
                        Lualaba en particulier est connue pour l’inadéquation
                        flagrante entre sa richesse minière et l’accessibilité à ces richesses par sa population.
                        Cela constitue un paradoxe qui se caractérise principalement par <b>le manque de progrès dans l’habitat en milieux ruraux</b>,
                        <b>le non-accès à l’énergie verte</b>, <b>les effets dévastateurs sur la faune et la flore</b>, <b>le non-accès à l’eau potable</b>,
                        <b>le dépeuplement des campagnes par l’exode rural</b>.",
            'visionTitle'=>'Vision de la fondation',
            'missionTitle'=>'Mission de la fondation',
            'visionContent'=>"
                    <ul>
                        <li> Prévoir le meilleur pour demain.</li>


                        <li> Agir pour anticiper</li>
                        <li>Mettre en œuvre la meilleure technicité</li>
                    </ul>
            ",
            'missionContent'=>"<p>
                    Aucune réalisation ne peut aboutir à un vrai succès sans une promotion de la formation ..... <br>
                    c'est ainsi que la fondation <strong>Rank</strong> a commission de:
                </p>
                <div>
                    <ul>
                        <li>Soutenir l'université Ukatesh</li>
                        <li>Lutter contre l'exode rural.</li>
                        <li>...</li>
                    </ul>
                </div>",
            'memberTitle'=>'Membres de la fondation',
            'memberContent'=>'<p>Peuvent être membres de la Fondation « Rank », toute personne physique ou morale de droit privé ou de droit public, sans autres restrictions ou réserves que celles prévues par la loi, les statuts et le règlement intérieur.
                La demande d’adhésion au statut de membre, s’opère au siège de la Fondation à partir d’un formulaire prévu quant à ce.
                L’adhésion à la Fondation est gratuite au <a class="btn btn-link rounded fw-bold text-decoration-none" href="javascript:void(0)">Lien ici</a>.
                </p>
                <h2>L\'équipe Rank</h2>',
            'tel'=>'243 992522582',
            'email'=>'rank@ukatesh.org',
            'address'=>'LUALABA, Ville:KOLWEZI, Commune:DILALA, Q/Mutoshi, N°:1309 Avenue Lumande',
            'condition'=>"
                Bienvenu à la fondation Rank, vous etes sur le point de devenir membre de la Fondation Rank,
            ",
            'aboutHome'=>"
                <h2>La fondation Rank, Un acteur majeur pour un développement durable du Lualaba</h2>
                <p>La fondation Rank est une organisation à but non lucratif qui œuvre pour le développement social et environnemental du Lualaba, en partenariat avec des universités innovantes et dynamiques comme l'Université Technologique Kanyik Tesh (Ukatesh).</p>
                <p>La fondation Rank s'engage à impacter positivement l'environnement, en utilisant l'expertise de l'Ukatesh dans les domaines de l'énergie, de la déforestation et des impacts liés à l'environnement minier dans le Lualaba, en République Démocratique du Congo.</p>
            ",
        ];
    }
}
