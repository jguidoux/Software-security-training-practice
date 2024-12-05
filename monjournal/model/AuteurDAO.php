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
						
			$sql = "SELECT nom,prenom FROM auteur WHERE identifiant='". $identifiant ."' AND motdepasse='". $motdepasse ."'";
			// SELECT nom,prenom FROM auteur WHERE identifiant='' or 1=1 -- ' AND motdepasse='". $motdepasse ."'"

			$st = $cnx->query($sql);

			if($enreg = $st->fetch())	{
			    $auteur = new Auteur();
			    $auteur->setIdentifiant($identifiant);
				$auteur->setMotDePasse($motdepasse);
				$auteur->setNom($enreg['nom']);
				$auteur->setPrenom($enreg['prenom']);
			    return $auteur;
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
