<!DOCTYPE html>
<html lang="fr">
  <head>
    <meta charset="utf-8">
  </head>
  <body>
    <h2>Requete Shap / Carte Prépayé</h2>
    <p>Éléments de la requête :</p>
    <ul>
      <li><strong>Nom</strong> : {{ $data['lastname'] }} {{ $data['firstname'] }}</li>
      <li><strong>Email</strong> : {{ $data['email'] }}</li>
      <li><strong>Téléphone</strong> : {{ $data['phone'] }}</li>
      <li><strong>Type de requête</strong> : {{ $data['type_query'] }}</li>
      <li><strong>Message</strong> : {{ $data['message'] }}</li>
    </ul>
  </body>
</html>
