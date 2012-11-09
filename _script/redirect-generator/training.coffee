fs = require 'fs'
data = [
	["/formations-methodes-agiles","/formations-methodes-agiles.html"],
	["/formations-methodes-agiles/formation-scrummaster-certifiante-en-francais-animee-par-petra-skapa","/formations-methodes-agiles.html"],
	["/formations-methodes-agiles/formation-scrummaster-jeff-sutherland","/formation-scrummaster-certifiante-anglais.html"],
	["/formations-methodes-agiles/formation-certifiante-product-owner-en-francais-animee-par-petra-skapa","/formation-scrum-product-owner-certifiante-francais.html"],
	["/formations-methodes-agiles/formation-product-owner-arlen-bankston","/formation-scrum-product-owner-certifiante-anglais.html"],
	["/formations-methodes-agiles/formation-scrummaster-academy","/formation-scrummaster-academy.html"],
	["/formations-methodes-agiles/formation-scrum-un-coach-en-pratique-veronique-messager-rota","/formation-scrum-un-coach-en-pratique.html"],
	["/formations-methodes-agiles/formation-introduction-a-scrum-animee-par-jean-laurent-de-morlhon","/formation-introduction-a-scrum.html"],
	["/formations-methodes-agiles/formation-developpement-logiciel-avec-le-lean-animee-par-mary-et-tom-poppendieck","/formation-developpement-logiciel-avec-le-lean.html"],
	["/formations-methodes-agiles/formation-kanban-avec-david-anderson","/formation-kanban.html"],
	["/formations-methodes-agiles/formation-strategicplay-lego-serious-play","/formations-methodes-agiles.html"],
	["/formations-methodes-agiles/formation-architecture-lean-animee-par-james-coplien","/formation-architecture-lean.html"],
	["/formations-methodes-agiles/formation-developpement-agile-avec-scrum-et-xp-animee-par-gilles-mantel","/formation-scrum-intra-entreprise.html"],
	["/formations-methodes-agiles/formation-tdd-animee-par-simon-caplette-2","/formation-tdd-software-craftsmanship.html"],
	["/formations-methodes-agiles/formation-agile-for-manager-animee-par-mack-adams","/formation-agile-managers.html"],
	["/formations-methodes-agiles/formations-agiles-avancees","/formations-methodes-agiles.html"],
	["/formations-methodes-agiles/formation-user-story-mapping-for-product-owners"],
	["/formations-methodes-agiles/formation-uml-agile-animee-par-michel-zam","/formations-methodes-agiles.html"],
	["/formations-java-jee","/formations-techniques.html"],
	["/formations-java-jee/formation-java-performance-tuning-kirk-pepperdine","/formation-java-performance-tuning.html"],
	["/formations-java-jee/formation-architectures-aujourdhui-java-ee-antonio-goncalves","/formation-java-ee-6.html"],
	["/formations-java-jee/java-concurrency-in-practice","/formation-java-concurrency-specialist.html"],
	["/formations-java-jee/the-well-grounded-java-developer","/formation-developpeur-java-moderne.html"],
	["/formations-java-jee/formation-mongodb-for-administrators-animee-par-10gen","/formation-mongodb.html"],
	["/formations-java-jee/formation-cloudera-developpeurs-pour-hadoop-apache","/formation-hadoop-certifiante-developpeurs.html"],
	["/formations-java-jee/formation-cloudera-administrateurs-pour-hadoop-apache","/formation-hadoop-certifiante-administrateurs.html"],
	["/formations-java-jee/formation-android-animee-par-pascal-ognibene","/formation-android.html"],
	["/formations-java-jee/formation-scala-animee-par-trond-bjerkestrand","/formation-scala.html"],
	["/formations-java-jee/formations-applications-java-pretes-pour-la-production-cyrille-leclerc","/formation-applications-java-production.html"],
	["/formations-java-jee/formation-software-craftsmanship","/formation-tdd-software-craftsmanship.html"],
	["/formations-java-jee/formation-troubleshooting-en-java-animee-par-pablo-lopez","/formation-troubleshooting-en-java.html"],
	["/formations-java-jee/formation-maven-nathaniel-richand","/formation-maven.html"],
	["/formations-java-jee/formation-html-5-animee-par-seven-le-mesle","/formation-html-5.html"],
	["/formations-java-jee/formation-devops-pour-java-animee-par-cyrille-le-clerc","/formation-devops-pour-java.html"],
	["/formations-java-jee/formation-cloud-computing-java-de-amazon-ec2-au-private-cloud","/formation-cloud-computing.html"],
	["/informations","/a-propos.html"],
	["/informations/nos-animateurs","/animateurs.html"],
	["/informations/nos-clients","/a-propos.html"],
	["/comment-financer-sa-formation","/comment-financer-sa-formation.html"],
	["/informations/formations-intra-entreprise","/formations-intra-entreprise.html"],
	["/informations/inscription","/inscription.html"], 
	["/les-etapes-pour-devenir-srcummaster","/devenir-scrum-master.html"],
	["/informations/xebia-essentials","/xebia-essentials.html"],
	["/informations/mentions-legales","/mentions-legales.html"],
	["/informations/conditions-generales-de-vente","/conditions-generales-de-vente.html"],
	["/promos","/promos.html"], 
	["/coaching-agile","/coaching-agile.html"],
	["/contact","/contact.html"],
	["/event-high-performance-26-juin","/news.html"],
	["/cloud-day-22-mai-chez-xebia","/news.html"],
	["/mongodb-day-paris","/news.html"],
	["/devoxx-france","/news.html"],
	["/sortie-du-livre-%C2%AB-scrum-en-action-%C2%BB-par-guillaume-bodet","/news.html"],
	["/sortie-du-livre-«-scrum-en-action-»-par-guillaume-bodet","/news.html"],
	["/formations-methodes-agiles/formation-scrummaster-certifiante-en-francais-animee-par-petra-skapa/comment-page-9","/formation-scrummaster-certifiante-francais.html"],
	["/formation-scrummaster-certifiante-en-francais-anglais","/formations-methodes-agiles.html"],#certifications-scrum
	["/formations-methodes-agiles/formation-scrummaster-jeff-sutherland/comment-page-11","/formation-scrummaster-certifiante-anglais.html"],
	["/formations-methodes-agiles/formation-certifiante-product-owner-en-francais-animee-par-petra-skapa/comment-page-4","/formation-scrum-product-owner-certifiante-francais.html"],
	["/formations-methodes-agiles/formation-product-owner-arlen-bankston/comment-page-4","/formation-scrum-product-owner-certifiante-anglais.html"],
	["/formations-methodes-agiles/formation-scrum-un-coach-en-pratique-veronique-messager-rota/comment-page-3","/formation-scrum-un-coach-en-pratique.html"],
	["/formations-methodes-agiles/formation-tdd-animee-par-simon-caplette-2/comment-page-1","/formation-tdd-software-craftsmanship.html"],
	["/formations-java-jee/formation-java-performance-tuning-kirk-pepperdine/comment-page-2","/formation-java-performance-tuning.html"],
	["/java-ee-6-book-by-antonio-goncalves","/formation-java-ee-6.html"],
	["/formations-java-jee/formation-architectures-aujourdhui-java-ee-antonio-goncalves/comment-page-1","/formation-java-ee-6.html"],
	["/atelier-performance-avec-kirk-pepperdine","/formation-java-performance-tuning.html"],
	["/formations-java-jee/formation-scala-avec-martin-odersky","/formation-scala.html"],
	["/formations-java-jee/formation-nosql-pour-les-applications-dentreprises-avec-michael-figuiere","/formations-techniques.html"],#formation-big-data
	["/formations-methodes-agiles/formation-scrummaster-certifiante-en-francais-animee-par-petra-skapa/comment-page-8","/formation-scrummaster-certifiante-francais.html"],
	["/formations-methodes-agiles/formation-scrummaster-jeff-sutherland/comment-page-10","/formation-scrummaster-certifiante-anglais.html"],
	["/formations-methodes-agiles/formation-certifiante-product-owner-en-francais-animee-par-petra-skapa/comment-page-3","/formation-scrum-product-owner-certifiante-francais.html"],
	["/formations-methodes-agiles/formation-product-owner-arlen-bankston/comment-page-3","/formation-scrum-product-owner-certifiante-anglais.html"],
	["/formations-methodes-agiles/formation-scrum-un-coach-en-pratique-veronique-messager-rota/comment-page-2","/formation-scrum-un-coach-en-pratique.html"],
	["/formations-java-quatrieme-trimestre","/news.html"],
	["/formations-nosql","/formations-techniques.html"],#formation-big-data
	["/un-nouveau-type-d%e2%80%99architecte-l%e2%80%99architecte-agile","/news.html"],
	["/presentation-de-scrum","/news.html"],
	["/event-contractualisation-agile","/news.html"],
	["/certification-scrum","/formations-methodes-agiles.html"],#certifications-scrum
	["/seminaire-developpement-offshore-et-agilite-l%e2%80%99huile-et-l%e2%80%99eau","/news.html"],
	["/seminaire-developpement-offshore-et-agilite","/news.html"],
	["/certification-scrum-product-owner-en-francais-animee-par-petra-skapa","/formation-scrum-product-owner-certifiante-francais.html"],
	["/certification-scrum-a-paris-en-francais-par-petra-skapa","/formations-methodes-agiles.html"],#certifications-scrum
	["/4-criteres-pour-bien-choisir-son-projet-agile-pilote","/news.html"],
	["/formation-sur-la-qualite-logicielle-a-paris","/news.html"],
	["/livre-blanc-qualite-logicielle-ecrit-par-frederic-dubois","/news.html"],
	["/rencontre-dsi-jeff-sutherland-fondateur-de-la-methode-agile-scrum","/news.html"],
	["/un-americain-a-paris-par-frederic-doillon","/news.html"],
	["/retrospective-formation-certifiante-scrummaster-par-fabrice-aimetti","/news.html"],
	["/i%e2%80%99m-now-a-scrummaster-par-nicolas-martignole","/news.html"],
	["/formation-scrummaster-par-jeff-sutherland-par-thomas-recloux","/news.html"],
	["/extreme-programming-%e2%80%93-xp","/formation-extreme-programming.html"],
	["/architecture-agile","/news.html"],
	["/les-outils-de-gestion-de-projet-par-veronique-messager-rota","/news.html"],
	["/a-propos-de-nous","/a-propos.html"],
	["/certification-product-owner-animee-par-arlen-bankston","/formation-scrum-product-owner-certifiante-anglais.html"],
	["/certification-scrummaster-animee-par-jeff-sutherland","/formation-scrummaster-certifiante-anglais.html"],
	["/formation-scrummaster-par-jeff-sutherland-par-christian-trotobas","/formation-scrummaster-certifiante-anglais.html"],
	["/formation-scrummaster-a-la-defense-par-david-andrianavalontsalama","/formation-scrummaster-certifiante-anglais.html"],
	["/certification-scrummaster-par-laurent-morisseau","/formation-scrummaster-certifiante-anglais.html"],
	["/formation-java-performance-tuning-a-sophia-antipolis","/formation-java-performance-tuning.html"],
	["/just-deployit","/news.html"],
	["/livre-gestion-de-projet-vers-les-methodes-agiles-de-veronique-messager-rota","/news.html"],
	["/scrum-entretien-avec-jeff-sutherland-a-paris","/news.html"]
]

output = "target"
fs.mkdirSync "#{output}"
for urlPair in data
	[ oldUrl, newUrl ] = urlPair
	console.log "#{oldUrl} -> #{newUrl}"
	# Creer un repertoire avec oldUrl
	fs.mkdirSync "#{output}/#{oldUrl[1..]}"
	content = """
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr-FR" lang="fr-FR">
<head>
	<meta charset="UTF-8" />
	<meta http-equiv="Refresh" content="0; url=#{newUrl}" />
	<title>Redirection</title>
	<meta name="robots" content="noindex" />
</head>
<body>
<p><a href="#{newUrl}">Redirection</a></p>
</body>
</html>
	"""
	fs.writeFileSync "#{output}/#{oldUrl[1..]}/index.html", content, "utf8"