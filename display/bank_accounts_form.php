<!-- Account Creation Form  -->
<div class="col-12 col-md-6 bg-dark text-white p-5">
  <form class="col-form-label" method="POST">
    <label for="account"> Account :
      <input class="form-control" type="text" name="account" required >
    </label>
    <br>
    <label for="owner"> Owner :
      <label for="prefix">
        <select name="prefix">
          <option value="Mr ">Mr</option>
          <option value="Mlle ">Mlle</option>
          <option value="Mme ">Mme</option>
        </select>
      </label>
      <input class="form-control" type="text" name="owner" required >
    </label>
    <br>
    <label for="account_type">
        <select name="account_type">
          <option value="card">Carte de crédit</option>
          <option value="card">Carte de paiement</option>
          <option value="saving">PEL</option>
          <option value="saving">Livret A</option>
        </select>
    </label>
    <br>
    <input class="btn btn-light" type="submit" name="bk_acc_submit" value="submit">
  </form>
</div>