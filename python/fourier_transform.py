from scipy.fftpack import fft
import matplotlib.pyplot as plt
"""
# Number of sample points
N = 600
# sample spacing
T = 1.0 / 800.0
x = np.linspace(0.0, N*T, N)
y = np.sin(50.0 * 2.0*np.pi*x) + 0.5*np.sin(80.0 * 2.0*np.pi*x)
yf = fft(y)
xf = np.linspace(0.0, 1.0/(2.0*T), N//2)

plt.plot(xf, 2.0/N * np.abs(yf[0:N//2]))

"""

x =[[1,2,3],[1,2,3]]
z = fft.fft2(x)
print(z)
plt.grid()
plt.show()
