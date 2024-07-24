import pandas as pd
import numpy as np
import json
import plotly.express as px
from sklearn.model_selection import train_test_split, cross_val_score
from sklearn.preprocessing import PolynomialFeatures, StandardScaler
from sklearn.linear_model import LinearRegression
from sklearn.metrics import mean_squared_error

data = pd.read_csv('../csv/astrodata.csv', low_memory=False)
df = pd.DataFrame(data)

numeric_cols = df.select_dtypes(include=[np.number]).columns
df[numeric_cols] = df[numeric_cols].fillna(df[numeric_cols].mean())

df = df[(df['pl_rade'] < 15) & (df['pl_orbper'] < 365*5)] # radius and orbital period

earth_radius = 1.0
earth_density = 1.0
earth_temperature = 255.0

def esi_value(x, x_earth, weight):
    return (1 - abs((x - x_earth) / (x + x_earth))) ** weight

df['esi_radius'] = esi_value(df['pl_rade'], earth_radius, 0.57)
df['esi_density'] = esi_value(df['pl_dens'], earth_density, 0.07)
df['esi_temperature'] = esi_value(df['pl_eqt'], earth_temperature, 0.07)

df['esi'] = (df['esi_radius'] * df['esi_density'] * df['esi_temperature']) ** (1 / (0.57 + 0.07 + 0.07))

X = df[['pl_rade', 'pl_insol', 'pl_orbper', 'pl_dens', 'pl_eqt']]
y = df['esi']


X_train, X_test, y_train, y_test = train_test_split(X, y, test_size=0.2, random_state=42)

def find_best_polynomial_degree(X_train, y_train, max_degree=5):
    best_degree = 1
    best_score = float('inf')
    for degree in range(1, max_degree + 1):
        poly = PolynomialFeatures(degree=degree)
        X_train_poly = poly.fit_transform(X_train)
        model = LinearRegression()
        scores = cross_val_score(model, X_train_poly, y_train, cv=5, scoring='neg_mean_squared_error')
        score = -np.mean(scores)
        if score < best_score:
            best_score = score
            best_degree = degree
    return best_degree


best_degree = find_best_polynomial_degree(X_train, y_train)
print(f'Best Polynomial Degree: {best_degree}')

poly = PolynomialFeatures(degree=best_degree)
X_train_poly = poly.fit_transform(X_train)
X_test_poly = poly.transform(X_test)

scaler = StandardScaler()
X_train_poly_scaled = scaler.fit_transform(X_train_poly)
X_test_poly_scaled = scaler.transform(X_test_poly)


model = LinearRegression()
model.fit(X_train_poly_scaled, y_train)

y_pred_train = model.predict(X_train_poly_scaled)
y_pred_test = model.predict(X_test_poly_scaled)

mse_train = mean_squared_error(y_train, y_pred_train)
mse_test = mean_squared_error(y_test, y_pred_test)
print(f'Mean Squared Error (Train): {mse_train}')
print(f'Mean Squared Error (Test): {mse_test}')


X_poly = poly.transform(X)
X_poly_scaled = scaler.transform(X_poly)
df['y_pred'] = model.predict(X_poly_scaled)

# fig = px.scatter(df, x='pl_rade', y='pl_insol', color='y_pred',
#                  title=f'Exoplanet ESI Prediction with Polynomial Regression (degree={best_degree})',
#                  labels={'pl_rade': 'Planet Radius (Earth radii)', 'pl_insol': 'Stellar Insolation (Earth insolation)', 'y_pred': 'Predicted ESI'})

# fig.show()

df.to_csv('../csv/processed_astrodata.csv', index=False)

hovertext = []
for index, row in df.iterrows():
    text = f"Radius: {row['pl_rade']}, Insolation: {row['pl_insol']}, ESI: {row['y_pred']:.2f}"
    hovertext.append(text)

plot_config = {
    'x': df['pl_rade'].tolist(),
    'y': df['pl_insol'].tolist(),
    'mode': 'markers',
    'marker': {
        'size': 4,
        'color': df['y_pred'].tolist(),
        'colorscale': 'YlOrRd',
        'showscale': True,
        'colorbar': {
            'title': 'Predicted ESI',
            'thickness': 15
        }
    },
    'type': 'scatter',
    'text': hovertext,
    'hoverinfo': 'text',
    'mse_train': mse_train,
    'mse_test': mse_test
}

json_output_path = '../json/astrodata_plot_config.json'
with open(json_output_path, 'w') as f:
    json.dump(plot_config, f)