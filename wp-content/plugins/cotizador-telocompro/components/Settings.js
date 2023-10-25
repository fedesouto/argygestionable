import React, { useState, useEffect } from "react";
import axios from "axios";

const Settings = () => {
  const [rates, setRates] = useState({});
  const [loader, setLoader] = useState("Save Settings");

  const url = `${appLocalizer.apiUrl}/ctlc/v1/rates`;

  const handleSubmit = (e) => {
    e.preventDefault();
    setLoader("Saving...");
    axios
      .post(
        url,
        {
          rates: rates,
        },
        {
          headers: {
            "content-type": "application/json",
            "X-WP-NONCE": appLocalizer.nonce,
          },
        }
      )
      .then((res) => {
        setLoader("Save Settings");
      });
  };
  const updateRatesState = (key, newValue) => {
    const newRates = rates.map((rate, index) => {
      if (index == key) {
        return {
          id: rate.id,
          monto: rate.monto,
          cuotas: rate.cuotas,
          rate: newValue,
        };
      } else return rate;
    });
    setRates(newRates);
  };

  useEffect(() => {
    axios.get(url).then((res) => {
      setRates(res.data.rates);
    });
  }, []);

  return (
    <React.Fragment>
      <h2>Cotizador Telocompro</h2>
      <form id="work-settings-form" onSubmit={(e) => handleSubmit(e)}>
        <table className="form-table" role="presentation">
          <thead>
            <tr>
              <th scope="col">Monto</th>
              <th scope="col">Cuotas</th>
              <th scope="col">Porcentaje</th>
            </tr>
          </thead>
          <tbody>
            {Object.keys(rates).map((key) => {
              return (
                <tr key={rates[key].id}>
                  <th scope="row">
                    <label>{rates[key].monto}</label>
                  </th>
                  <th scope="row">
                    <label>{rates[key].cuotas}</label>
                  </th>
                  <td>
                    <input
                      name={rates[key]}
                      value={rates[key].rate}
                      onChange={(event) =>
                        updateRatesState(key, event.target.value)
                      }
                      className="regular-text"
                    />
                  </td>
                </tr>
              );
            })}
          </tbody>
        </table>
        <p className="submit">
          <button type="submit" className="button button-primary">
            {loader}
          </button>
        </p>
      </form>
    </React.Fragment>
  );
};

export default Settings;
