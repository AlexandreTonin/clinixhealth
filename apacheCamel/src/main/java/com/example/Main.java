package com.example;

import org.apache.camel.Exchange;
import org.apache.camel.builder.RouteBuilder;
import org.apache.camel.impl.DefaultCamelContext;

public class Main {

    public static void main(String[] args) throws Exception {
        // Cria o contexto do Camel
        DefaultCamelContext context = new DefaultCamelContext();

        // Define a rota do Camel
        context.addRoutes(new RouteBuilder() {
            @Override
            public void configure() throws Exception {
                // Rota para escutar requisição SOAP via HTTP
                from("jetty://http://localhost:8080/soap-paciente")
                    .log("Recebendo requisição SOAP: ${body}")
                    .setHeader(Exchange.HTTP_METHOD, constant("GET"))
                    .to("http://localhost:3000/?bridgeEndpoint=true")
                    .log("Resposta: ${body}");
            }
        });

        // Inicia o CamelContext
        context.start();

        // Aguardar para que as rotas sejam processadas
        Thread.sleep(60 * 60 * 1000);

        // Para o CamelContext após o processamento
        context.stop();
    }
}
