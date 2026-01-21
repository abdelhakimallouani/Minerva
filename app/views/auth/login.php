<h2>Login</h2>

<?php if (!empty($error)) echo "<p style='color:red'>$error</p>"; ?>

<form method="POST" action="/login">
    <input type="email" name="email" placeholder="Email" required>
    <input type="password" name="password" placeholder="Mot de passe" required>
    <button type="submit">Login</button>
</form>

<p>
    <a href="/register">Créer compte enseignant</a>
</p>

