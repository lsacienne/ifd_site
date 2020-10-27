<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Critiques</title>
  </head>
  <body>
    <h1>Saisir critique</h1><br/>
    <form method="post" action="add_critic.php">

      <label for="jeux">Jeux:</label>
      <select id="jeux" name="jeux">
          <option value="Uno">Uno</Fr></option>
          <option value="Munchkin">Munchkin</option>
      </select><br/><br/>

	    <label for="titre">Titre:</label>
	    <input name="titre" type="text" required/> <br /><br />

	    <label for="note">Note (/10):</label>
	    <input name="note" type="text" required/> <br /><br />

      <label for="content">Avis:</label><br /><br />
	    <textarea name="content" cols="40" rows="10"></textarea><br /><br />

      <button type="submit">Poster</button>
    </form>
  </body>
</html>
