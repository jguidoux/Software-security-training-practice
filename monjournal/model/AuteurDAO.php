<?php

namespace model;

class AuteurDAO {
	
	/**
	 * Méthode d'authentification des auteurs.
	 * 
	 * @param string $identifiant L'identifiant utilisateur.
	 * @param string $motdepasse Le mot de passe utilisateur.
	 * @return Auteur L'objet Auteur authentifié.
	 */
	public function authentifier(string $identifiant, string $motdepasse) : Auteur {
		$cnx = null;
	    try {
			$cnx = DBUtil::connexion();
						
			// $sql = "SELECT nom,prenom FROM auteur WHERE identifiant='". $identifiant ."' AND motdepasse='". $motdepasse ."'";
			// SELECT nom,prenom FROM auteur WHERE identifiant='' or 1=1 -- ' AND motdepasse='". $motdepasse ."'"

			// On utilise une requête préparée pour éviter les injections SQL
			// :id et :mdp sont des variables qu'il faudra remplacer par leurs valeurs avant exécution
			// $sql = "SELECT nom,prenom FROM auteur WHERE identifiant=:id AND motdepasse=:mdp";
			$sql = "SELECT nom,prenom,motdepasse FROM auteur WHERE identifiant=:id";

			// On envoi la requete au serveur MySQL pour analyse
			$st = $cnx->prepare($sql);

			// On exécute la requete en remplaçant les variables par leurs valeurs.
			// $st = $cnx->query($sql);
			$st->execute(
				[
					':id' => $identifiant,
					// ':mdp' => $motdepasse
				]
			);

			if($enreg = $st->fetch())	{
				if(password_verify($motdepasse, $enreg['motdepasse'])) { // Comparaison du mot de passe avec le hash
					$auteur = new Auteur();
					$auteur->setIdentifiant($identifiant);
					// $auteur->setMotDePasse($motdepasse);
					$auteur->setNom($enreg['nom']);
					$auteur->setPrenom($enreg['prenom']);
					return $auteur;
				}
				else {
					throw new \Exception("Erreur lors de l'authentification.");
				}
			}
			else 
			    throw new \Exception("Erreur lors de l'authentification.");
			
		} 
		catch (\Exception $e) {
			throw new \Exception("Erreur lors de l'authentification.");
		}
		finally {
		    DBUtil::deconnexion($cnx);
		}
	}
}
