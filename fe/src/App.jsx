import { Card, CardContent } from "@/components/ui/card";
import { Container } from "@/components/ui/container";
import "./App.css";
import EventTable from "./components/eventTable";
import { Route, Routes } from "react-router-dom";
import DetailPage from "./components/detail";
import EventForm from "./components/eventForm";
import { Toaster } from "@/components/ui/toaster";
import { QueryClient, QueryClientProvider } from "@tanstack/react-query";

const queryClient = new QueryClient();

function App() {
  return (
    <QueryClientProvider client={queryClient}>
      <Container className="max-w-5xl p-4 mx-auto">
        <Card>
          <CardContent>
            <Routes>
              <Route path="/" element={<EventTable />} />
              <Route path="/event/new" element={<EventForm />} />
              <Route path="/event/:id" element={<DetailPage />} />
              <Route path="/event/:id/edit" element={<EventForm />} />
            </Routes>
            <Toaster />
          </CardContent>
        </Card>
      </Container>
    </QueryClientProvider>
  );
}

export default App;
