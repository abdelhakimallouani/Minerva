<h2>Register</h2>

<form method="POST" action="/register">
    <input name="name" placeholder="Nom" required>
    <input type="email" name="email" required>
    <input type="password" name="password" required>

    <select name="role">
        <option value="student">Étudiant</option>
        <option value="teacher">Enseignant</option>
    </select>

    <button type="submit">Créer</button>
</form>
