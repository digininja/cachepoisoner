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
	return c.Render(randomNumber)
}
