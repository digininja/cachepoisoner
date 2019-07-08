package controllers

import (
	"fmt"
	"github.com/revel/revel"
	"html/template"
	"math/rand"
	"time"
)

type App struct {
	*revel.Controller
}

func init() {
	/*
		Things to look at:

		https://revel.github.io/manual/template-engine.html
		https://revel.github.io/manual/templates-go.html#CustomFunctions
		https://www.calhoun.io/intro-to-templates-p3-functions/

	*/

	revel.TemplateFuncs["my_eq"] = func(a, b interface{}) bool {
		return a == 0 || a == b
	}

	revel.TemplateFuncs["htmlAttr"] = func(html string) template.HTMLAttr {
		return (template.HTMLAttr(fmt.Sprintf("%s", html)))
	}

}

func (c App) Index() revel.Result {
	randomSource := rand.NewSource(time.Now().UnixNano())
	random := rand.New(randomSource)
	randomNumber := random.Intn(10000)

	host := c.Request.Host
	if c.Request.Header.Get("X-Forwarded-Host") != "" {
		host = c.Request.Header.Get("X-Forwarded-Host")
	}
	url := fmt.Sprintf("src=\"http://%s/public/img/ninja.png\"", host)

	return c.Render(randomNumber, host, url)
}
