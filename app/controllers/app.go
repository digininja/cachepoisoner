package controllers

import (
	"github.com/revel/revel"
	"math/rand"
	"time"
)

type App struct {
	*revel.Controller
}

func (c App) Index() revel.Result {
	randomSource := rand.NewSource(time.Now().UnixNano())
	random := rand.New(randomSource)
	randomNumber := random.Intn(10000)

	host := c.Request.Host
	if c.Request.Header.Get("X-Forwarded-Host") != "" {
		host = c.Request.Header.Get("X-Forwarded-Host")
	}

	return c.Render(randomNumber, host)
}
