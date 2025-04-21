<form method="POST" action="{{ route('authentication') }}">
    @csrf
    <label>Email:</label>
    <input type="email" name="email" value="">
    <label>Пароль:</label>
    <input type="password" name="password" value="">
    <button type="submit">Отправить</button>
</form>
